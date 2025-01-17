<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Purchase Entity
 *
 * @property int $id
 * @property int|null $status_id
 * @property int $supplier_id
 * @property string|null $reference
 * @property int|null $qty
 * @property \Cake\I18n\DateTime|null $receipt_date
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\Paymentstosupplier[] $paymentstosuppliers
 * @property \App\Model\Entity\Purchasesitem[] $purchasesitems
 */
class Purchase extends Entity
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
        'status_id' => true,
        'supplier_id' => true,
        'reference' => true,
        'qty' => true,
        'receipt_date' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'status' => true,
        'supplier' => true,
        'paymentstosuppliers' => true,
        'purchasesitems' => true,
    ];
}
