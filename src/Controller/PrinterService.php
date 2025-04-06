<?php
declare(strict_types=1);

namespace App\Controller;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class PrinterService
{
    public function printReceipt(string $text): void
    {
        // Use the Windows printer name as configured
        $connector = new WindowsPrintConnector('POS-58-Series');

        $printer = new Printer($connector);

        // Print text and cut
        $printer->text($text . "\n");
        $printer->cut();
        $printer->close();
    }
}
