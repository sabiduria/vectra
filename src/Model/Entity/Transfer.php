<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transfer Entity
 *
 * @property int $id
 * @property string|null $reference
 * @property int $shop_id
 * @property int|null $receiver_id
 * @property string|null $reason
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\Transfersdetail[] $transfersdetails
 */
class Transfer extends Entity
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
        'reference' => true,
        'shop_id' => true,
        'receiver_id' => true,
        'reason' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'shop' => true,
        'transfersdetails' => true,
    ];
}
