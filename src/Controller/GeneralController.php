<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\DateTime;
use Cake\ORM\TableRegistry;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GeneralController extends AppController
{
    /**
     * @return void
     */
    public function dashboard(): void
    {
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function monitoring(): void
    {
        $this->viewBuilder()->setLayout('dashboard');
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

    /**
     * @param $table
     * @return mixed|null
     */
    public static function getCountAll($table): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COUNT(*) as nber FROM ' . strtolower($table));
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return null;
    }

    public static function getNameOf($id, $tableName): ?string
    {
        $table = TableRegistry::getTableLocator()->get($tableName)
            ->find()
            ->select(['name'])
            ->where(['id' => $id])
            ->first();

        return $table ? $table->name : null;
    }

    public static function getReferenceOf($id, $tableName): ?string
    {
        $table = TableRegistry::getTableLocator()->get($tableName)
            ->find()
            ->select(['reference'])
            ->where(['id' => $id])
            ->first();

        return $table ? $table->reference : null;
    }

    public static function getUserNameOf($id): ?string
    {
        $table = TableRegistry::getTableLocator()->get('Users');

        $user = $table->find()
            ->select([
                'name' => $table->query()->newExpr()->add([
                    'CONCAT(firstname, " ", lastname)'
                ])
            ])
            ->where(['id' => $id])
            ->first();

        return $user ? $user->name : null;
    }

    static function dateDiffInDays($date1, $date2): float|int
    {
        $diff = strtotime($date2) - strtotime($date1);
        return abs(round($diff / 86400));
    }

    public static function NewPricings($product_id, $packaging_id, $unit_price, $wholesale_price, $special_price, $username){
        $connection = ConnectionManager::get('default');

        $connection->insert('pricings', [
            'product_id' => $product_id,
            'packaging_id' => $packaging_id,
            'unit_price' => $unit_price,
            'wholesale_price' => $wholesale_price,
            'special_price' => $special_price,
            'created' => new DateTime('now'),
            'modified' => new DateTime('now'),
            'createdby' => $username,
            'modifiedby' => $username,
            'deleted' => 0
        ], ['created' => 'datetime', 'modified' => 'datetime']);
    }

    public static function NewShopStocks($product_id, $room_id, $stock, $stock_min, $stock_max, $username): void
    {
        $connection = ConnectionManager::get('default');

        $connection->insert('shopstocks', [
            'product_id' => $product_id,
            'room_id' => $room_id,
            'stock' => $stock,
            'stock_min' => $stock_min,
            'stock_max' => $stock_max,
            'created' => new DateTime('now'),
            'modified' => new DateTime('now'),
            'createdby' => $username,
            'modifiedby' => $username,
            'deleted' => 0
        ], ['created' => 'datetime', 'modified' => 'datetime']);
    }

    public static function NewStockInsDetails($product_id, $room_id, $purchase_price, $tax, $barcode, $qty, $expiry_date, $username): void
    {
        $connection = ConnectionManager::get('default');

        $connection->insert('stockinsdetails', [
            'product_id' => $product_id,
            'stockin_id' => self::getLastIdInsertedBy($username, 'stockins'),
            'room_id' => $room_id,
            'purchase_price' => $purchase_price,
            'tax' => $tax,
            'barcode' => $barcode,
            'qty' => $qty,
            'expiry_date' => $expiry_date,
            'entry_state' => 1,
            'created' => new DateTime('now'),
            'modified' => new DateTime('now'),
            'createdby' => $username,
            'modifiedby' => $username,
            'deleted' => 0
        ], ['created' => 'datetime', 'modified' => 'datetime']);
    }

    public static function NewStockIns($shop_id, $username): void
    {
        $connection = ConnectionManager::get('default');

        $connection->insert('stockins', [
            'entrytype_id' => 1,
            'shop_id' => $shop_id,
            'reference' => self::generateReference('Stockins', 'ENT'),
            'created' => new DateTime('now'),
            'modified' => new DateTime('now'),
            'createdby' => $username,
            'modifiedby' => $username,
            'deleted' => 0
        ], ['created' => 'datetime', 'modified' => 'datetime']);
    }

    public static function getLastIdInsertedBy($username, $tableName): ?int
    {
        $table = TableRegistry::getTableLocator()->get($tableName)
            ->find()
            ->select(['id'])
            //->where(['createdby' => $username])
            ->orderByDesc('id')
            ->first();

        return $table ? $table->id : null;
    }

    public static function getShopIdFromRoom($room_id): ?int
    {
        $table = TableRegistry::getTableLocator()->get('Rooms')
            ->find()
            ->select(['shops_id'])
            ->where(['id' => $room_id])
            ->first();

        return $table ? $table->shops_id : null;
    }

    public static function getProductDetails($barcode): ?string
    {
        $table = TableRegistry::getTableLocator()->get('Products');

        $data = $table->find()
            ->select([
                'details' => $table->query()->newExpr()->add([
                    'CONCAT(id, "-", packaging_id)'
                ])
            ])
            ->where(['barcode' => $barcode])
            ->first();

        return $data ? $data->details : null;
    }

    public static function getProductPrices($barcode): ?string
    {
        $table = TableRegistry::getTableLocator()->get('Pricings');

        $data = $table->find()
            ->select([
                'details' => $table->query()->newExpr()->add([
                    'CONCAT(unit_price, "-", wholesale_price, "-", special_price)'
                ])
            ])
            ->where(['barcode' => $barcode])
            ->first();

        return $data ? $data->details : null;
    }

    public static function NewSalesItems($barcode, $username): void
    {
        $connection = ConnectionManager::get('default');

        $product = explode('-', self::getProductDetails($barcode));
        $pricings = explode('-', self::getProductPrices($barcode));
        $salesId = GeneralController::getLastIdInsertedBy($username, 'Sales');
        $addCheck = self::productAlreadyAdd($product[0], $salesId);
        $currentQty = self::getCurrentQty($product[0], $salesId);

        if ($addCheck){
            $newQty = $currentQty+1;
            $newPrice = $newQty * $pricings[0];
            $connection->update('Salesitems', [
                'qty' => $newQty,
                'subtotal' => $newPrice
            ], [
                'sale_id' => $salesId
            ]);
        } else{
            $connection->insert('Salesitems', [
                'product_id' => $product[0],
                'sale_id' => $salesId,
                'qty' => 1,
                'packaging_id' => $product[1],
                'unit_price' => $pricings[0],
                'subtotal' => $pricings[0],
                'created' => new DateTime('now'),
                'modified' => new DateTime('now'),
                'createdby' => $username,
                'modifiedby' => $username,
                'deleted' => 0
            ], ['created' => 'datetime', 'modified' => 'datetime']);
        }
    }

    public static function getSalesDetails($salesId): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT si.id, p.name product, p.id product_id, si.qty, si.unit_price, pkg.name packaging, si.subtotal FROM salesitems si INNER JOIN products p ON p.id = si.product_id INNER JOIN packagings pkg ON pkg.id = si.packaging_id WHERE sale_id=:sale_id;', ['sale_id' => $salesId]);
        return $stmt->fetchAll('assoc');
    }

    public static function productAlreadyAdd($product_id, $sale_id): bool
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COUNT(*) as nber FROM salesitems WHERE product_id = :product_id AND sale_id = :sale_id', ['product_id' => $product_id, 'sale_id' => $sale_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row > 0;
        }

        return false;
    }

    public static function getCurrentQty($product_id, $sale_id): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT qty as nber FROM salesitems WHERE product_id = :product_id AND sale_id = :sale_id', ['product_id' => $product_id, 'sale_id' => $sale_id]);
        $result = $stmt->fetch('assoc');

        if ($result != null){
            foreach ($result as $row) {
                return $row;
            }
        }

        return 0;
    }

    public static function getSalesAmount($sale_id): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT SUM(subtotal) as nber FROM salesitems WHERE sale_id = :sale_id', ['sale_id' => $sale_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row != null ? $row : 0;
        }

        return null;
    }
}
