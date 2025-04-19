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

    public static function getSupplierData($data, $supplier_id): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT '.$data.' FROM suppliers WHERE id = :supplier_id', ['supplier_id' => $supplier_id]);
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

    public static function NewPricings($barcode, $product_id, $packaging_id, $unit_price, $wholesale_price, $special_price, $username){
        $connection = ConnectionManager::get('default');

        $connection->insert('pricings', [
            'barcode' => $barcode,
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

    public static function getIDFromReference($reference, $tableName): ?int
    {
        $table = TableRegistry::getTableLocator()->get($tableName)
            ->find()
            ->select(['id'])
            ->where(['reference' => $reference])
            ->orderByDesc('id')
            ->first();

        return $table ? $table->id : null;
    }

    public static function getPurchaseId($PGReference, $supplier_id): ?int
    {
        $table = TableRegistry::getTableLocator()->get("Purchases")
            ->find()
            ->select(['id'])
            ->where(['purchase_group_reference' => $PGReference, 'supplier_id' => $supplier_id])
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

    public static function getProductPrices($barcode, $packaging_id): ?string
    {
        $table = TableRegistry::getTableLocator()->get('Pricings');

        $data = $table->find()
            ->select([
                'details' => $table->query()->newExpr()->add([
                    'CONCAT(unit_price, "-", wholesale_price, "-", special_price)'
                ])
            ])
            ->where(['barcode' => $barcode, 'packaging_id' => $packaging_id])
            ->first();

        return $data ? $data->details : null;
    }

    public static function NewSalesItems($barcode, $packaging_id, $username): void
    {
        $connection = ConnectionManager::get('default');

        $product = explode('-', self::getProductDetails($barcode));
        if ($packaging_id != null)
            $pricings = explode('-', self::getProductPrices($barcode, $packaging_id));
        else
            $pricings = explode('-', self::getProductPrices($barcode, $product[1]));
        $salesId = GeneralController::getLastIdInsertedBy($username, 'Sales');
        $addCheck = self::productAlreadyAdd($product[0], $salesId);
        $currentQty = self::getCurrentQty($product[0], $salesId);

        if ($addCheck){
            $newQty = $currentQty+1;
            $newPrice = $newQty * $pricings[0];
            $connection->update('Salesitems', [
                'unit_price' => $pricings[0],
                'qty' => $newQty,
                'subtotal' => $newPrice
            ], [
                'sale_id' => $salesId, 'product_id' => $product[0]
            ]);
        } else{
            $connection->insert('Salesitems', [
                'product_id' => $product[0],
                'sale_id' => $salesId,
                'qty' => 1,
                'packaging_id' => $packaging_id != null ? $packaging_id : $product[1],
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
        $stmt = $conn->execute('SELECT si.id, p.name product, p.image, p.id product_id, si.qty, si.unit_price, pkg.name packaging, si.subtotal FROM salesitems si INNER JOIN products p ON p.id = si.product_id INNER JOIN packagings pkg ON pkg.id = si.packaging_id WHERE sale_id=:sale_id;', ['sale_id' => $salesId]);
        return $stmt->fetchAll('assoc');
    }

    public static function getAllCategories(): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT C.id, C.name, COUNT(P.id) AS product_count FROM categories C LEFT JOIN products P ON P.category_id = C.id GROUP BY C.id, C.name;');
        return $stmt->fetchAll('assoc');
    }

    public static function getAllProducts($shop_id): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT P.id, C.name, P.image, P.reference, P.name, SUM(SS.stock) stock, SS.stock_min, SS.stock_max FROM products P
        INNER JOIN shopstocks SS ON SS.product_id=P.id
        INNER JOIN rooms R ON R.id = SS.room_id
        INNER JOIN categories C ON C.id = P.category_id
        WHERE R.shops_id = :shop_id
        GROUP BY P.id;', ['shop_id' => $shop_id]);
        return $stmt->fetchAll('assoc');
    }

    public static function getProspectionsPrices($product_id): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT P.id, P.product_id, P.supplier_id, S.name supplier, PK.name packaging, P.price, P.created FROM prospections P INNER JOIN suppliers S ON S.id = P.supplier_id INNER JOIN packagings PK ON PK.id = P.packaging_id WHERE product_id = :product_id', ['product_id' => $product_id]);
        return $stmt->fetchAll('assoc');
    }

    public static function getPOSProduct(): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT P.category_id, C.name category_name, P.barcode, P.id product_id, P.name product_name, PC.packaging_id, PG.name packaging, PC.unit_price FROM products P INNER JOIN pricings PC ON PC.product_id = P.id INNER JOIN packagings PG ON PG.id = PC.packaging_id INNER JOIN categories C ON C.id = P.category_id;');
        return $stmt->fetchAll('assoc');
    }

    public static function getPOData($PGReference): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT P.id, P.status_id, SS.name as status, P.supplier_id, S.name supplier, P.reference, P.due_date, P.receipt_date, P.purchase_group_reference, P.created, P.modified, P.createdby, P.modifiedby, P.deleted FROM purchases P INNER JOIN suppliers S ON S.id = P.supplier_id INNER JOIN statuses SS ON SS.id = P.status_id WHERE P.purchase_group_reference = :PGReference;', ['PGReference' => $PGReference]);
        return $stmt->fetchAll('assoc');
    }

    public static function getItemCount(): int
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COUNT(*) as nber FROM products');
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getPurchasedItems($purchase_id): int
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COUNT(product_id) nber FROM purchasesitems WHERE purchase_id=:purchase_id', ['purchase_id' => $purchase_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getPurchasedItemsQuantity($purchase_id): float
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT SUM(qty) nber FROM purchasesitems WHERE purchase_id=:purchase_id', ['purchase_id' => $purchase_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getSalesItemsQuantity($sale_id): float
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT SUM(qty) nber FROM salesitems WHERE sale_id=:sale_id', ['sale_id' => $sale_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getSalesItemsNumber($sale_id): float
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COUNT(product_id) nber FROM salesitems WHERE sale_id=:sale_id', ['sale_id' => $sale_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getPurchasesNumber($purchase_group): int
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COUNT(*) nber FROM purchases WHERE purchase_group_reference=:purchase_group', ['purchase_group' => $purchase_group]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getPurchasesItemsNumber($purchase_group): float
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COALESCE(SUM(PI.qty), 0) nber FROM purchases P INNER JOIN purchasesitems PI ON P.id = PI.purchase_id WHERE P.purchase_group_reference=:purchase_group', ['purchase_group' => $purchase_group]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getPurchasesItemsAmount($purchase_group): float
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COALESCE(SUM(PI.qty * PI.price), 0) nber FROM purchases P INNER JOIN purchasesitems PI ON P.id = PI.purchase_id WHERE P.purchase_group_reference=:purchase_group', ['purchase_group' => $purchase_group]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getPurchasesGroupStatus($purchase_group): string
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute("SELECT CASE
         WHEN COUNT(*) = 0 THEN '<span class=\"badge bg-warning\">En attente de livraison</span>'
         WHEN COUNT(receipt_date) = 0 AND MAX(due_date) < NOW() THEN '<span class=\"badge bg-danger\">En retard de livraison</span>'
         WHEN COUNT(receipt_date) = 0 THEN '<span class=\"badge bg-warning\">En attente de livraison</span>'
         WHEN COUNT(receipt_date) = COUNT(*) THEN '<span class=\"badge bg-success\">Achat réceptionné</span>'
         WHEN COUNT(*) > COUNT(receipt_date) AND MAX(due_date) < NOW() THEN '<span class=\"badge bg-danger\">En retard de livraison</span>'
         ELSE '<span class=\"badge bg-info\">Partiellement Réçu</span>'
       END AS receipt_status
FROM purchases
WHERE purchase_group_reference = :purchase_group",
            ['purchase_group' => $purchase_group]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return "";
    }

    public static function getPurchasesStatus($purchase_id): string
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute("SELECT CASE
         WHEN COUNT(*) = 0 THEN '<span class=\"badge bg-warning\">En attente de livraison</span>'
         WHEN COUNT(receipt_date) = 0 AND MAX(due_date) < NOW() THEN '<span class=\"badge bg-danger\">En retard de livraison</span>'
         WHEN COUNT(receipt_date) = 0 THEN '<span class=\"badge bg-warning\">En attente de livraison</span>'
         WHEN COUNT(receipt_date) = COUNT(*) THEN '<span class=\"badge bg-success\">Achat réceptionné</span>'
         WHEN COUNT(*) > COUNT(receipt_date) AND MAX(due_date) < NOW() THEN '<span class=\"badge bg-danger\">En retard de livraison</span>'
         ELSE '<span class=\"badge bg-info\">Partiellement Réçu</span>'
       END AS receipt_status
FROM purchases
WHERE id = :purchase_id",
            ['purchase_id' => $purchase_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return "";
    }

    public static function getPOAmount($purchase_id): float
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT SUM(qty*price) total FROM purchasesitems WHERE purchase_id=:purchase_id', ['purchase_id' => $purchase_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getPOSpentAmount($purchase_id): float
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COALESCE(SUM(amount), 0) total FROM spents WHERE purchase_id=:purchase_id', ['purchase_id' => $purchase_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
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

    public static function NewPurchaseGroup($shop_id, $username): string
    {
        $connection = ConnectionManager::get('default');
        $reference = self::generateReference('Purchasegroups', 'PG');

        $connection->insert('purchasegroups', [
            'shop_id' => $shop_id,
            'reference' => $reference,
            'created' => new DateTime('now'),
            'modified' => new DateTime('now'),
            'createdby' => $username,
            'modifiedby' => $username,
            'deleted' => 0
        ], ['created' => 'datetime', 'modified' => 'datetime']);

        return $reference;
    }

    public static function POForSupplierAlreadyAdd($purchase_group_reference, $supplier_id): bool
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COUNT(*) as nber FROM purchases WHERE purchase_group_reference = :purchase_group_reference AND supplier_id = :supplier_id', ['purchase_group_reference' => $purchase_group_reference, 'supplier_id' => $supplier_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row > 0;
        }

        return false;
    }

    public static function NewPurchaseOrder($supplier_id, $purchase_group_reference, $username): string
    {
        $connection = ConnectionManager::get('default');
        $reference = self::generateReference('Purchases', 'PO');

        $connection->insert('purchases', [
            'status_id' => 1,
            'supplier_id' => $supplier_id,
            'purchase_group_reference' => $purchase_group_reference,
            'reference' => $reference,
            'created' => new DateTime('now'),
            'modified' => new DateTime('now'),
            'createdby' => $username,
            'modifiedby' => $username,
            'deleted' => 0
        ], ['created' => 'datetime', 'modified' => 'datetime']);

        return $reference;
    }

    public static function NewPurchaseOrderDetails($purchase_id, $product_id, $qty, $price, $username): void
    {
        $connection = ConnectionManager::get('default');

        $connection->insert('purchasesitems', [
            'purchase_id' => $purchase_id,
            'product_id' => $product_id,
            'qty' => $qty,
            'price' => $price,
            'created' => new DateTime('now'),
            'modified' => new DateTime('now'),
            'createdby' => $username,
            'modifiedby' => $username,
            'deleted' => 0
        ], ['created' => 'datetime', 'modified' => 'datetime']);

    }

    public static function getPODetails($PGReference): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT PI.id, PI.purchase_id, S.name supplier, PI.product_id, PD.name product, PD.image, PI.qty, PI.price, PI.qty*PI.price total, PI.created FROM purchasesitems PI INNER JOIN purchases P ON P.id = PI.purchase_id INNER JOIN suppliers S ON S.id = P.supplier_id INNER JOIN products PD ON PD.id = PI.product_id WHERE P.purchase_group_reference=:purchase_group_reference;', ['purchase_group_reference' => $PGReference]);
        return $stmt->fetchAll('assoc');
    }

    public static function getLatestExchangeRate(): float
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT rates FROM exchangerates ORDER BY id DESC LIMIT 1');
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }

    public static function getClientIDFromPhone($phone): float
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT id FROM customers WHERE phone=:phone', ['phone' => $phone]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return 0;
    }
}
