<?php
declare(strict_types=1);

namespace App\Controller;

use RuntimeException;

class PrinterService
{
    public $commands = [
        // Printer initialization
        'init' => ["\x1B\x40", ''],

        // Font selection
        'font_a' => ["\x1B\x4D\x00", ''],  // Font A (normal)
        'font_b' => ["\x1B\x4D\x01", "\x1B\x4D\x00"],  // Font B (small)

        // Text alignment
        'left' => ["\x1B\x61\x00", ''],    // Left align (default)
        'center' => ["\x1B\x61\x01", "\x1B\x61\x00"],  // Center align
        'right' => ["\x1B\x61\x02", "\x1B\x61\x00"],   // Right align

        // Character scaling
        'normal_size' => ["\x1B\x21\x00", ''],  // Normal size (default)
        'double_height' => ["\x1B\x21\x10", "\x1B\x21\x00"],
        'double_width' => ["\x1B\x21\x20", "\x1B\x21\x00"],
        'double_size' => ["\x1B\x21\x30", "\x1B\x21\x00"],

        // Bold text
        'bold_on' => ["\x1B\x45\x01", "\x1B\x45\x00"],  // Bold on
        'bold_off' => ["\x1B\x45\x00", ''],  // Bold off (default)

        // Underline
        'underline_on' => ["\x1B\x2D\x01", "\x1B\x2D\x00"],
        'underline_off' => ["\x1B\x2D\x00", ''],

        // Other commands
        'cut' => ["\x1D\x56\x41\x00", ''],
        'feed' => ["\x1B\x64\x03", ''],  // Feed 3 lines
    ];

    private $handle;

    public function getHandle(): mixed
    {
        $printer = GeneralParamsController::getData('printer_name');
        if (!$this->handle) {
            $printer_name = '\\\\localhost\\' . $printer;
            $this->handle = fopen($printer_name, 'w');

            if (!$this->handle) {
                //throw new RuntimeException('Cannot connect to printer');
                return ['status' => 'error', 'message' => 'Cannot connect to printer'];
            }
        }

        return $this->handle;
    }

    public function closeHandle(): void
    {
        if ($this->handle) {
            fclose($this->handle);
            $this->handle = null;
        }
    }

    // Function to apply multiple formats with automatic reset

    public function formatText(string $text, array $formatCommands): void
    {
        $handle = $this->getHandle();

        // Apply all formatting commands
        foreach ($formatCommands as $cmd) {
            if (isset($this->commands[$cmd])) {
                fwrite($handle, $this->commands[$cmd][0]);
            }
        }

        // Print the text
        fwrite($handle, $text);

        // Reset all formatting commands (in reverse order)
        foreach (array_reverse($formatCommands) as $cmd) {
            if (isset($this->commands[$cmd][1]) && !empty($this->commands[$cmd][1])) {
                fwrite($handle, $this->commands[$cmd][1]);
            }
        }
    }

    // Function to print item line with proper columns

    public function printItem(string $article, float $qty, float $price): void
    {
        // Calculate total
        $total = $qty * $price;

        // Format the line with fixed column widths
        $line = sprintf(
            '%-25s %10s %10s %10s',
            substr($article, 0, 20),  // Article (max 20 chars)
            $qty . ' | ',                     // Quantity
            number_format($price, 2), // Price
            ' | '. number_format($total, 2)  // Total
        );

        $this->formatText($line . "\n", ['left', 'font_b']);
    }

    // Calculate order total

    private function getOrderTotal(array $products): float
    {
        return array_reduce($products, function ($carry, $item) {
            return $carry + ($item[1] * $item[2]);
        }, 0);
    }

    public function printLabel(array $products, $sale_id): void
    {
        $sales = SalesController::getData($sale_id);
        try {
            $handle = $this->getHandle();

            // Build receipt
            fwrite($handle, $this->commands['init'][0]); // Initialize printer

            // Header (centered and bold)
            $this->formatText("LA HOPA INVESTMENTS\n", ['center', 'double_height', 'bold_on']);
            $this->formatText('No. RCCM : ' . GeneralParamsController::getData('rccm') . "\n", ['center', 'font_b']);
            $this->formatText('ID NAT : ' . GeneralParamsController::getData('idnat') . "\n", ['center', 'font_b']);
            $this->formatText('No. IMPOT : ' . GeneralParamsController::getData('impot') . "\n", ['center', 'font_b']);
            $this->formatText("MARCHE LUILU EN FACE DU CERCLE\n", ['center', 'font_b']);
            $this->formatText("C. DILALA, V. KOLWEZI, P. LUALABA\n", ['center', 'font_b']);
            $this->formatText("-----------------------------------------------\n", ['center']);

            // Store information
            $this->formatText('Caissier: ' . $sales[0]['cashier'] . "\n", ['left', 'font_b']);
            $this->formatText('Date: ' . date('Y-m-d H:i:s') . "\n", ['left', 'font_b']);
            $this->formatText('Facture #' . $sales[0]['reference'] . "\n\n", ['left', 'font_b']);

            // Items header (underlined)
            $this->formatText("Articles                      Qty    Price         Total\n", ['left', 'font_b']);
            $this->formatText("-----------------------------------------------\n", ['left']);

            // Print all items
            foreach ($products as $item) {
                $this->printItem($item[0], $item[1], $item[2]);
            }

            $orderTotal = $this->getOrderTotal($products);
            $tax = $orderTotal * 0.15;
            //$totalWithTax = $orderTotal + $tax;

            // Order total
            $this->formatText("\n", ['left']);
            $this->formatText("-----------------------------------------------\n", ['left']);
            $this->formatText('SUB TOTAL: ' . number_format($orderTotal, 2) . "\n", ['right']);
            $this->formatText('TAX (15%): ' . number_format($tax, 2) . "\n", ['right']);
            $this->formatText('TOTAL: ' . number_format($orderTotal, 2) . "\n", ['right', 'bold_on']);

            // Client Information
            $this->formatText("-----------------------------------------------\n", ['left']);
            $this->formatText("Information du Client\n\n", ['center', 'font_b']);
            $this->formatText('Nom: ' . $sales[0]['customer'] . "\n", ['left', 'font_b']);
            $this->formatText('Telephone: ' . $sales[0]['phone'] . "\n", ['left', 'font_b']);
            $this->formatText("-----------------------------------------------\n", ['left']);

            // Payment and footer
            $this->formatText("\nPayment: Cash\n", ['left']);
            //$this->formatText("Change: $5.25\n\n", ['left']);
            $this->formatText("Merci pour votre achat!\n", ['center', 'font_b']);
            $this->formatText("Ouvert du Lundi au Dimanche de 07H30 a 15H00\n", ['center', 'font_b']);
            $this->formatText("La marchandise vendue n'est ni remise ni echangee\n\n", ['center', 'font_b']);
            $this->formatText("www.lahopainvestments.com\n", ['center', 'font_b']);

            // Add some empty space and cut
            fwrite($handle, $this->commands['feed'][0]);
            fwrite($handle, $this->commands['cut'][0]);

            //echo 'Receipt printed successfully!';
        } finally {
            $this->closeHandle();
        }
    }
}
