<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\SalesAnalyticsService;
use Cake\Datasource\ConnectionManager;
use Cake\Http\ServerRequest;
use Cake\I18n\Date;
use Cake\I18n\DateTime;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GeneralController extends AppController
{
    /**
     * @return void
     */
    public function dashboard(): void
    {
        $request = new ServerRequest();
        $this->viewBuilder()->setLayout('dashboard');
        self::performanceMetrics();
        self::salesTrend();
        self::revenueGrowth();
        self::stockTrend();
        self::generalDashboardMetrics();
        self::salesDashboard();
        self::UpdateProductMetrics();
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

    public static function getCountPerPackage($packaging_id): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT COUNT(*) as nber FROM products WHERE packaging_id =:packaging_id', ['packaging_id' => $packaging_id]);
        $result = $stmt->fetch('assoc');
        foreach ($result as $row) {
            return $row;
        }

        return null;
    }

    public static function getLatestExchangeRates(): mixed
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT rates FROM exchangerates ORDER BY created LIMIT 1');
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
            $connection->update('salesitems', [
                'unit_price' => $pricings[0],
                'qty' => $newQty,
                'subtotal' => $newPrice
            ], [
                'sale_id' => $salesId, 'product_id' => $product[0]
            ]);
        } else{
            $connection->insert('salesitems', [
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

    public function reportExpense()
    {

    }

    public function abc()
    {

    }

    public function performanceMetrics()
    {
        // Fetch data for the last 12 months
        $timeframe = new DateTime('first day of this month -11 months');
        $startDate = $timeframe->format('Y-m-d 00:00:00');

        // --- SALES METRICS ---
        $salesData = TableRegistry::getTableLocator()->get('Sales')
            ->find()
            ->select([
                'month' => 'DATE_FORMAT(Sales.created, "%Y-%m")',
                'total_sales' => 'SUM(Sales.total_amount)',
                'total_profit' => 'SUM(SalesItems.subtotal - (Stockinsdetails.purchase_price * SalesItems.qty))'
            ])
            ->join([
                'SalesItems' => [
                    'table' => 'salesitems',
                    'type' => 'INNER',
                    'conditions' => 'SalesItems.sale_id = Sales.id'
                ],
                'Products' => [
                    'table' => 'products',
                    'type' => 'INNER',
                    'conditions' => 'Products.id = SalesItems.product_id'
                ],
                'Stockinsdetails' => [
                    'table' => 'stockinsdetails',
                    'type' => 'INNER',
                    'conditions' => 'Products.id = Stockinsdetails.product_id'
                ]
            ])
            ->where(['Sales.created >=' => $startDate])
            ->group('month')
            ->order('month')
            ->toArray();

        // --- GROWTH RATE CALCULATION ---
        $metrics = [];
        foreach ($salesData as $key => $record) {
            $metrics[$record->month] = [
                'sales' => (float)$record->total_sales,
                'profit' => (float)$record->total_profit,
                'growth' => ($key > 0) && $salesData[$key-1]->total_sales > 0
                    ? (($record->total_sales - $salesData[$key-1]->total_sales) / $salesData[$key-1]->total_sales) * 100
                    : 0
            ];
        }

        $this->set(compact('metrics'));
        $this->viewBuilder()->setOption('serialize', ['metrics']);
    }

    public function salesTrend()
    {
        $startDate = $this->request->getQuery('start_date', new FrozenTime('-1 month'));
        $endDate = $this->request->getQuery('end_date', new FrozenTime('now'));

        $Categories = $this->fetchTable('Categories');

        $this->set([
            'salesStats' => $Categories->find('salesStatistics', compact('startDate', 'endDate'))->toArray(),
            'monthlyTrend' => $Categories->find('monthlyTrend', [
                'start_date' => new FrozenTime('-12 months'),
                'end_date' => new FrozenTime('now')
            ])->toArray(),
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function revenueGrowth()
    {
        // Prevent JSON view from being auto-rendered
        $this->viewBuilder()->setOption('serialize', true);

        // Get date range (default: last 12 months)
        $startDate = $this->request->getQuery('start_date', (new Date('-12 months'))->format('Y-m-d'));
        $endDate = $this->request->getQuery('end_date', (new Date()))->format('Y-m-d');

        // Get comparison period (previous year or previous period)
        $comparePeriod = $this->request->getQuery('compare_period', 'previous_year');

// Convert string dates to DateTime objects
        $startDateObj = new DateTime($startDate);
        $endDateObj = new DateTime($endDate);

        if ($comparePeriod === 'previous_year') {
            // For year comparison, subtract 1 year from both dates
            $compareStart = (clone $startDateObj)->modify('-1 year')->format('Y-m-d');
            $compareEnd = (clone $endDateObj)->modify('-1 year')->format('Y-m-d');
        } else {
            // For period comparison, calculate the difference between dates
            $interval = $startDateObj->diff($endDateObj);
            $compareStart = (clone $startDateObj)->sub($interval)->format('Y-m-d');
            $compareEnd = (clone $startDateObj)->modify('-1 day')->format('Y-m-d');
        }

        // Fetch data
        $data = [
            'time_period' => [
                'current' => ['start' => $startDate, 'end' => $endDate],
                'comparison' => ['start' => $compareStart, 'end' => $compareEnd]
            ],
            'revenue_trends' => $this->getRevenueTrends($startDate, $endDate, $compareStart, $compareEnd),
            'growth_metrics' => $this->getGrowthMetrics($startDate, $endDate, $compareStart, $compareEnd),
            'product_performance' => $this->getProductPerformance($startDate, $endDate),
            'customer_segments' => $this->getCustomerSegments($startDate, $endDate),
            'sales_channels' => $this->getSalesChannels($startDate, $endDate),
            'revenue_health' => $this->getRevenueHealthIndicators()
        ];

        $this->set(compact('data'));
    }

    protected function getRevenueTrends($startDate, $endDate, $compareStart, $compareEnd)
    {
        $Sales = $this->fetchTable('Sales');
        // Current period revenue by month
        $currentRevenue = $Sales->find()
            ->select([
                'period' => 'DATE_FORMAT(Sales.created, "%Y-%m")',
                'total' => 'SUM(Sales.total_amount)',
                'count' => 'COUNT(Sales.id)'
            ])
            ->where(function ($exp) use ($startDate, $endDate) {
                return $exp->between('Sales.created', $startDate, $endDate);
            })
            ->group('period')
            ->order('period')
            ->all()
            ->toArray();

        // Comparison period revenue by month
        $comparisonRevenue = $Sales->find()
            ->select([
                'period' => 'DATE_FORMAT(Sales.created, "%Y-%m")',
                'total' => 'SUM(Sales.total_amount)',
                'count' => 'COUNT(Sales.id)'
            ])
            ->where(function ($exp) use ($compareStart, $compareEnd) {
                return $exp->between('Sales.created', $compareStart, $compareEnd);
            })
            ->group('period')
            ->order('period')
            ->all()
            ->toArray();

        return [
            'current' => $currentRevenue,
            'comparison' => $comparisonRevenue
        ];
    }

    protected function getGrowthMetrics($startDate, $endDate, $compareStart, $compareEnd)
    {
        $Sales = $this->fetchTable('Sales');
        // Total revenue for current period
        $currentTotal = $Sales->find()
            ->select(['total' => 'SUM(Sales.total_amount)'])
            ->where(function ($exp) use ($startDate, $endDate) {
                return $exp->between('Sales.created', $startDate, $endDate);
            })
            ->first()
            ->total ?? 0;

        // Total revenue for comparison period
        $comparisonTotal = $Sales->find()
            ->select(['total' => 'SUM(Sales.total_amount)'])
            ->where(function ($exp) use ($compareStart, $compareEnd) {
                return $exp->between('Sales.created', $compareStart, $compareEnd);
            })
            ->first()
            ->total ?? 0;

        // Calculate growth metrics
        $revenueGrowth = $comparisonTotal != 0
            ? (($currentTotal - $comparisonTotal) / $comparisonTotal) * 100
            : ($currentTotal > 0 ? 100 : 0);

        // Customer count growth
        $currentCustomers = $Sales->find()
            ->select(['count' => 'COUNT(DISTINCT Sales.customer_id)'])
            ->where(function ($exp) use ($startDate, $endDate) {
                return $exp->between('Sales.created', $startDate, $endDate);
            })
            ->first()
            ->count ?? 0;

        $comparisonCustomers = $Sales->find()
            ->select(['count' => 'COUNT(DISTINCT Sales.customer_id)'])
            ->where(function ($exp) use ($compareStart, $compareEnd) {
                return $exp->between('Sales.created', $compareStart, $compareEnd);
            })
            ->first()
            ->count ?? 0;

        $customerGrowth = $comparisonCustomers != 0
            ? (($currentCustomers - $comparisonCustomers) / $comparisonCustomers) * 100
            : ($currentCustomers > 0 ? 100 : 0);

        // Average order value
        $currentAOV = $currentTotal / max(1, $this->getSalesCount($startDate, $endDate));
        $comparisonAOV = $comparisonTotal / max(1, $this->getSalesCount($compareStart, $compareEnd));
        $aovGrowth = $comparisonAOV != 0
            ? (($currentAOV - $comparisonAOV) / $comparisonAOV) * 100
            : ($currentAOV > 0 ? 100 : 0);

        return [
            'revenue' => [
                'current' => $currentTotal,
                'comparison' => $comparisonTotal,
                'growth' => $revenueGrowth,
                'direction' => $revenueGrowth >= 0 ? 'up' : 'down'
            ],
            'customers' => [
                'current' => $currentCustomers,
                'comparison' => $comparisonCustomers,
                'growth' => $customerGrowth,
                'direction' => $customerGrowth >= 0 ? 'up' : 'down'
            ],
            'aov' => [
                'current' => $currentAOV,
                'comparison' => $comparisonAOV,
                'growth' => $aovGrowth,
                'direction' => $aovGrowth >= 0 ? 'up' : 'down'
            ]
        ];
    }

    protected function getProductPerformance($startDate, $endDate)
    {
        $SalesItems = $this->fetchTable('salesitems');
        // Previous period subquery (3 months prior)
        $prevStart = (new Date($startDate))->subMonths(3)->format('Y-m-d');
        $prevEnd = (new Date($startDate))->subDays(1)->format('Y-m-d');

        $prevPeriod = $SalesItems->find()
            ->select([
                'product_id',
                'total' => 'SUM(salesitems.subtotal)'
            ])
            ->where(function ($exp) use ($prevStart, $prevEnd) {
                return $exp->between('salesitems.created', $prevStart, $prevEnd);
            })
            ->group('product_id');

        // Main query
        $query = $SalesItems->find();

        // Build the SQL query
        $sql = "
        SELECT
            Products.id AS product_id,
            Products.name AS product_name,
            Categories.name AS category,
            SUM(Salesitems.subtotal) AS total_sales,
            SUM(Salesitems.qty) AS quantity,
            CASE
                WHEN prevy.total IS NULL OR prevy.total = 0 THEN
                    CASE
                        WHEN SUM(Salesitems.subtotal) > 0 THEN 100
                        ELSE 0
                    END
                ELSE
                    ((SUM(Salesitems.subtotal) - prevy.total) / prevy.total) * 100
            END AS growth
        FROM
            salesitems Salesitems
        INNER JOIN
            products Products ON Products.id = Salesitems.product_id
        INNER JOIN
            categories Categories ON Categories.id = Products.category_id
        LEFT JOIN
            (
                SELECT
                    Salesitems.product_id,
                    SUM(Salesitems.subtotal) AS total
                FROM
                    salesitems Salesitems
                WHERE
                    Salesitems.created BETWEEN :previousStart AND :previousEnd
                GROUP BY
                    Salesitems.product_id
            ) prevy ON prevy.product_id = Products.id
        WHERE
            Salesitems.created BETWEEN :currentStart AND :currentEnd
        GROUP BY
            Products.id, Products.name, Categories.name, prevy.total
        ORDER BY
            total_sales DESC
        LIMIT 10
    ";

        // Get database connection
        $connection = ConnectionManager::get('default');

        $statement = $connection->execute($sql, [
            'currentStart' => $startDate,
            'currentEnd' => $endDate,
            'previousStart' => $prevStart,
            'previousEnd' => $prevEnd]);

        // Fetch results
        $results = $statement->fetchAll('assoc');

        // Format the results if needed
        foreach ($results as &$row) {
            $row['total_sales'] = (float)$row['total_sales'];
            $row['quantity'] = (float)$row['quantity'];
            $row['growth'] = (float)$row['growth'];
        }

        return $results;
    }

    protected function getCustomerSegments($startDate, $endDate)
    {
        // Implementation for customer segmentation
        // ...
    }

    protected function getSalesChannels($startDate, $endDate)
    {
        // Implementation for sales channel analysis
        // ...
    }

    protected function getRevenueHealthIndicators()
    {
        // Implementation for revenue health KPIs
        // ...
    }

    protected function getSalesCount($startDate, $endDate)
    {
        $Sales = $this->fetchTable('Sales');
        return $Sales->find()
            ->where(function ($exp) use ($startDate, $endDate) {
                return $exp->between('Sales.created', $startDate, $endDate);
            })
            ->count();
    }

    protected function stockTrend()
    {
        $shopstocksTable = $this->fetchTable('Shopstocks');

        // Critical stock (below 50% of min)
        $criticalStock = $shopstocksTable->find('criticalStock')->all();

        // Low stock (below min but above 50%)
        $lowStock = $shopstocksTable->find('lowStock')
            ->where(['Shopstocks.stock <= (Shopstocks.stock_min + (Shopstocks.stock_min * 0.5))'])
            ->all();

        // Stock history for chart - need to execute query first
        $stockHistory = $shopstocksTable->find('stockHistory', [
            'product_id' => $this->request->getQuery('product_id', 1),
            'room_id' => $this->request->getQuery('room_id', 1)
        ])->all(); // Added ->all() here to convert to collection

        // Get products and rooms for dropdowns
        $products = $shopstocksTable->Products->find('list')->all();
        $rooms = $shopstocksTable->Rooms->find('list')->contain(['Shops'])->all();

        // Aggregates for summary cards
        $stats = $shopstocksTable->find()
            ->select([
                'total_items' => 'COUNT(Shopstocks.id)',
                'low_stock_items' => 'SUM(CASE WHEN Shopstocks.stock < Shopstocks.stock_min THEN 1 ELSE 0 END)',
                'critical_items' => 'SUM(CASE WHEN Shopstocks.stock < Shopstocks.stock_min * 0.5 THEN 1 ELSE 0 END)',
                'avg_stock_vs_min' => 'AVG(Shopstocks.stock/Shopstocks.stock_min)'
            ])
            ->first();

        $this->set(compact('criticalStock', 'lowStock', 'stockHistory', 'stats', 'products', 'rooms'));
    }

    public function exportStockCsv()
    {
        $shopstocksTable = $this->getTableLocator()->get('Shopstocks');
        $data = $shopstocksTable->find('lowStock')
            ->contain(['Products', 'Rooms.Shops'])
            ->all();

        $_serialize = 'data';
        $_header = ['Product', 'Shop', 'Room', 'Current Stock', 'Min Stock', 'Deficit'];
        $_extract = [
            'product.name',
            'room.shop.name',
            'room.name',
            'stock',
            'stock_min',
            function ($row) {
                return $row['stock_min'] - $row['stock'];
            }
        ];

        $this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOption('serialize', 'data');
    }

    public function generalDashboardMetrics()
    {
        // Get date ranges
        $today = FrozenDate::today();
        $startOfMonth = $today->firstOfMonth();
        $endOfMonth = $today->lastOfMonth();
        $lastMonthStart = $startOfMonth->subMonths(1);
        $lastMonthEnd = $endOfMonth->subMonths(1);

        // Load required tables
        $salesTable = TableRegistry::getTableLocator()->get('Sales');
        $productsTable = TableRegistry::getTableLocator()->get('Products');
        $shopStocksTable = TableRegistry::getTableLocator()->get('ShopStocks');
        $attendancesTable = TableRegistry::getTableLocator()->get('Attendances');
        $expensesTable = TableRegistry::getTableLocator()->get('Expenses');

        // Sales Metrics
        $currentMonthSales = $salesTable->find()
            ->where(['created >=' => $startOfMonth, 'created <=' => $endOfMonth])
            ->select(['total' => $salesTable->find()->func()->sum('total_amount')])
            ->first()
            ->total;

        $lastMonthSales = $salesTable->find()
            ->where(['created >=' => $lastMonthStart, 'created <=' => $lastMonthEnd])
            ->select(['total' => $salesTable->find()->func()->sum('total_amount')])
            ->first()
            ->total;

        $salesGrowth = $lastMonthSales > 0
            ? (($currentMonthSales - $lastMonthSales) / $lastMonthSales) * 100
            : 100;

        // Top Products
        $topProducts = $productsTable->find()
            ->select([
                'Products.name',
                'total_sold' => 'SUM(Salesitems.qty)',
                'total_revenue' => 'SUM(Salesitems.subtotal)'
            ])
            ->innerJoinWith('Salesitems')
            ->group('Products.id')
            ->order(['total_revenue' => 'DESC'])
            ->limit(5)
            ->toArray();

        // Inventory Alerts
        $lowStockItems = $shopStocksTable->find()
            ->contain(['Products'])
            ->where(['stock < stock_min'])
            ->order(['stock' => 'ASC'])
            ->limit(10)
            ->toArray();

        // Attendance Data
        $attendanceStats = $attendancesTable->find()
            ->select([
                'affectation_id',
                'present_days' => 'COUNT(DISTINCT DATE(check_in))',
                'total_days' => $today->diffInDays($startOfMonth) + 1
            ])
            ->where(['check_in >=' => $startOfMonth, 'check_in <=' => $endOfMonth])
            ->group('affectation_id')
            ->contain(['Affectations.Users'])
            ->toArray();

        // Expense Breakdown
        $expenseCategories = $expensesTable->find()
            ->select([
                'name' => 'Expensestypes.name',
                'total_amount' => 'SUM(Expenses.amount)'
            ])
            ->contain(['Expensestypes'])
            ->where(['Expenses.created >=' => $startOfMonth, 'Expenses.created <=' => $endOfMonth])
            ->group('Expensestypes.name')
            ->order(['total_amount' => 'DESC'])
            ->toArray();

        // Sales Trend Data (Last 6 Months)
        $salesTrend = $salesTable->find()
            ->select([
                'month' => 'DATE_FORMAT(created, "%Y-%m")',
                'total_sales' => 'SUM(total_amount)'
            ])
            ->where(['created >=' => $today->subMonths(6)])
            ->group('month')
            ->order(['month' => 'ASC'])
            ->toArray();

        $this->set(compact(
            'currentMonthSales',
            'lastMonthSales',
            'salesGrowth',
            'topProducts',
            'lowStockItems',
            'attendanceStats',
            'expenseCategories',
            'salesTrend',
            'startOfMonth',
            'endOfMonth'
        ));
    }

    public function salesDashboard()
    {
        $salesService = new SalesAnalyticsService();

        // Default to last 30 days
        $startDate = $this->request->getQuery('start_date', date('Y-m-d', strtotime('-30 days')));
        $endDate = $this->request->getQuery('end_date', date('Y-m-d'));
        $shopId = $this->request->getQuery('shop_id');

        $options = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'shop_id' => $shopId
        ];

        $summary = $salesService->getSalesSummary($options);
        $trend = $salesService->getSalesTrend('daily', $options);
        $topProducts = $salesService->getTopProducts(5, $options);
        $customerMetrics = $salesService->getCustomerMetrics($options);

        // For AJAX requests, return JSON
        if ($this->request->is('ajax')) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(compact('summary', 'trend', 'topProducts', 'customerMetrics')));
        }

        $this->set(compact('summary', 'trend', 'topProducts', 'customerMetrics', 'startDate', 'endDate', 'shopId'));

        // Load shops for filter dropdown
        $shops = $this->fetchTable('Shops')->find('list')->toArray();
        $this->set('shops', $shops);
    }

    //UpdateProductMetrics
    private function calculateAnnualDemand(int $productId): float
    {
        $salesItemsTable = $this->getTableLocator()->get('SalesItems');

        $result = $salesItemsTable->find()
            ->where(['product_id' => $productId])
            ->innerJoinWith('Sales', function ($q) {
                return $q->where(['Sales.created >=' => new DateTime('-12 months')]);
            })
            ->select(['total' => 'SUM(Salesitems.qty)'])
            ->first();

        return $result ? (float)$result->total : 0.0;
    }

    private function calculateOrderingCost(int $productId): float
    {
        // Example: Avg. procurement cost from purchases
        $purchasesItemsTable = $this->getTableLocator()->get('Purchasesitems');
        $avgCost = $purchasesItemsTable->find()
            ->where(['product_id' => $productId])
            ->select(['avg_price' => 'AVG(price)'])
            ->first();

        return $avgCost ? (float)$avgCost->avg_price : 0.0;
    }

    private function calculateHoldingCost(int $productId): float
    {
        // Example: 20% of product's avg. price
        return $this->calculateOrderingCost($productId) * 0.2;
    }

    private function calculateLeadTimeDays(int $productId): int
    {
        // Example: Avg. days between purchase order and receipt
        $purchasesTable = $this->getTableLocator()->get('Purchases');
        $avgLeadTime = $purchasesTable->find()
            ->where(['Purchasesitems.product_id' => $productId])
            ->select(['avg_lead' => 'AVG(DATEDIFF(receipt_date, Purchases.created))'])
            ->innerJoinWith('Purchasesitems')
            ->first();

        return $avgLeadTime ? (int)$avgLeadTime->avg_lead : 7; // Default 7 days
    }

    public function UpdateProductMetrics()
    {
        $productsTable = $this->getTableLocator()->get('Products');

        // Fetch all active products (modify conditions as needed)
        $products = $productsTable->find()
            ->where(['deleted' => 0])
            ->all();

        $updatedCount = 0;
        foreach ($products as $product) {
            // Calculate new values (replace with your logic)
            $annualDemand = $this->calculateAnnualDemand($product->id);
            $orderingCost = $this->calculateOrderingCost($product->id);
            $holdingCost = $this->calculateHoldingCost($product->id);
            $leadTimeDays = $this->calculateLeadTimeDays($product->id);

            // Update the product
            $product->annual_demand = $annualDemand;
            $product->ordering_cost = $orderingCost;
            $product->holding_cost = $holdingCost;
            $product->lead_time_days = $leadTimeDays;

            if ($productsTable->save($product)) {
                $updatedCount++;
            }
        }
    }
}
