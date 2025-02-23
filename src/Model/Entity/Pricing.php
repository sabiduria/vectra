<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pricing Entity
 *
 * @property int $id
 * @property string|null $barcode
 * @property int $product_id
 * @property int $packaging_id
 * @property float|null $unit_price
 * @property float|null $wholesale_price
 * @property float|null $special_price
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Packaging $packaging
 */
class Pricing extends Entity
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
        'barcode' => true,
        'product_id' => true,
        'packaging_id' => true,
        'unit_price' => true,
        'wholesale_price' => true,
        'special_price' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'product' => true,
        'packaging' => true,
    ];
}
