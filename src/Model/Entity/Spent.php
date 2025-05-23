<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Spent Entity
 *
 * @property int $id
 * @property int $purchase_id
 * @property int $spenttype_id
 * @property string|null $description
 * @property float|null $amount
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Purchase $purchase
 * @property \App\Model\Entity\Spenttype $spenttype
 */
class Spent extends Entity
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
        'purchase_id' => true,
        'spenttype_id' => true,
        'description' => true,
        'amount' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'purchase' => true,
        'spenttype' => true,
    ];
}
