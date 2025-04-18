<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sale Entity
 *
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property int|null $customer_id
 * @property string|null $reference
 * @property float|null $total_amount
 * @property string|null $payment_method
 * @property int|null $status_id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\Salesitem[] $salesitems
 */
class Sale extends Entity
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
        'shop_id' => true,
        'user_id' => true,
        'customer_id' => true,
        'reference' => true,
        'total_amount' => true,
        'payment_method' => true,
        'status_id' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'user' => true,
        'customer' => true,
        'status' => true,
        'salesitems' => true,
    ];
}
