<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string|null $image
 * @property int $supplier_id
 * @property int $category_id
 * @property string|null $reference
 * @property string|null $barcode
 * @property string|null $name
 * @property string|null $specifications
 * @property string|null $notes
 * @property int|null $packaging_id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Packaging $packaging
 * @property \App\Model\Entity\Inventory[] $inventories
 * @property \App\Model\Entity\Ordersitem[] $ordersitems
 * @property \App\Model\Entity\Pricing[] $pricings
 * @property \App\Model\Entity\Promotionsproduct[] $promotionsproducts
 * @property \App\Model\Entity\Purchasesitem[] $purchasesitems
 * @property \App\Model\Entity\Salesitem[] $salesitems
 * @property \App\Model\Entity\Shopstock[] $shopstocks
 * @property \App\Model\Entity\Spoilage[] $spoilages
 * @property \App\Model\Entity\Stockinsdetail[] $stockinsdetails
 * @property \App\Model\Entity\Transfersdetail[] $transfersdetails
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'image' => true,
        'supplier_id' => true,
        'category_id' => true,
        'reference' => true,
        'barcode' => true,
        'name' => true,
        'specifications' => true,
        'notes' => true,
        'packaging_id' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'supplier' => true,
        'category' => true,
        'packaging' => true,
        'inventories' => true,
        'ordersitems' => true,
        'pricings' => true,
        'promotionsproducts' => true,
        'purchasesitems' => true,
        'salesitems' => true,
        'shopstocks' => true,
        'spoilages' => true,
        'stockinsdetails' => true,
        'transfersdetails' => true,
    ];
}
