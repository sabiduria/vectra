<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Stockinsdetail Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $stockin_id
 * @property int|null $room_id
 * @property float|null $purchase_price
 * @property float|null $tax
 * @property string|null $barcode
 * @property float|null $qty
 * @property \Cake\I18n\Date|null $expiry_date
 * @property int|null $entry_state
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Stockin $stockin
 * @property \App\Model\Entity\Room $room
 */
class Stockinsdetail extends Entity
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
        'stockin_id' => true,
        'room_id' => true,
        'purchase_price' => true,
        'tax' => true,
        'barcode' => true,
        'qty' => true,
        'expiry_date' => true,
        'entry_state' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'product' => true,
        'stockin' => true,
        'room' => true,
    ];
}
