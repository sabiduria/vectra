<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GeneralParam Entity
 *
 * @property int $id
 * @property string|null $business_name
 * @property string|null $rccm
 * @property string|null $idnat
 * @property string|null $impot
 * @property string|null $printer_name
 * @property string|null $printer_ip
 * @property float|null $growth
 * @property float|null $whole_sale_price_percent
 * @property float|null $special_price_percent
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 */
class GeneralParam extends Entity
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
        'business_name' => true,
        'rccm' => true,
        'idnat' => true,
        'impot' => true,
        'printer_name' => true,
        'printer_ip' => true,
        'growth' => true,
        'whole_sale_price_percent' => true,
        'special_price_percent' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
    ];
}
