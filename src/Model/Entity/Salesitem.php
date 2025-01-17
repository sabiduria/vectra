<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Salesitem Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $sale_id
 * @property float|null $qty
 * @property int|null $packaging_id
 * @property float|null $unit_price
 * @property float|null $subtotal
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Sale $sale
 * @property \App\Model\Entity\Packaging $packaging
 */
class Salesitem extends Entity
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
        'product_id' => true,
        'sale_id' => true,
        'qty' => true,
        'packaging_id' => true,
        'unit_price' => true,
        'subtotal' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'product' => true,
        'sale' => true,
        'packaging' => true,
    ];
}
