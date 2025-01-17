<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Supplier Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $phone1
 * @property string|null $phone2
 * @property string|null $email
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Product[] $products
 * @property \App\Model\Entity\Purchase[] $purchases
 */
class Supplier extends Entity
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
        'name' => true,
        'address' => true,
        'phone1' => true,
        'phone2' => true,
        'email' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'products' => true,
        'purchases' => true,
    ];
}
