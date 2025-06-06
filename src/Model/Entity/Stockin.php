<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Stockin Entity
 *
 * @property int $id
 * @property int $entrytype_id
 * @property int $shop_id
 * @property string|null $reference
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Entrytype $entrytype
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\Stockinsdetail[] $stockinsdetails
 */
class Stockin extends Entity
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
        'entrytype_id' => true,
        'shop_id' => true,
        'reference' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'entrytype' => true,
        'shop' => true,
        'stockinsdetails' => true,
    ];
}
