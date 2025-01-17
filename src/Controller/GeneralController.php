<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GeneralController extends AppController
{
    /**
     * @return void
     */
    public function dashboard(): void
    {
        
    }

    /**
     * @param $table
     * @param $prefix
     * @return string
     */
    public static function generateReference($table, $prefix): string
    {
        $number = self::getCountAll($table);

        if ($number == 0 || $number == null) {
            $reference = '0000001';
        } elseif ($number > 0 && $number < 10) {
            $reference = '000000' . ($number + 1);
        } elseif ($number >= 10 && $number < 100) {
            $reference = '00000' . ($number + 1);
        } elseif ($number >= 100 && $number < 999) {
            $reference = '0000' . ($number + 1);
        } elseif ($number >= 1000 && $number < 9999) {
            $reference = '000' . ($number + 1);
        } elseif ($number >= 10000 && $number < 99999) {
            $reference = '00' . ($number + 1);
        } else {
            $reference = '0' . ($number + 1);
        }

        return $prefix . '-' . $reference;
    }
}
