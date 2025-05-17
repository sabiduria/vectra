<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MarketProspection Entity
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $vendor
 * @property int|null $packaging_id
 * @property float|null $price
 * @property float|null $whole_price
 * @property float|null $special_price
 * @property string|null $comments
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Packaging $packaging
 */
class MarketProspection extends Entity
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
        'vendor' => true,
        'packaging_id' => true,
        'price' => true,
        'whole_price' => true,
        'special_price' => true,
        'comments' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'product' => true,
        'packaging' => true,
    ];
}
