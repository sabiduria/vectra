<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payroll Entity
 *
 * @property int $id
 * @property int $salary_id
 * @property \Cake\I18n\Date|null $period_start
 * @property \Cake\I18n\Date|null $period_end
 * @property float|null $period_salary
 * @property float|null $salary_payed
 * @property float|null $deductions
 * @property float|null $bonus
 * @property bool|null $totally_payed
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Salary $salary
 */
class Payroll extends Entity
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
        'salary_id' => true,
        'period_start' => true,
        'period_end' => true,
        'period_salary' => true,
        'salary_payed' => true,
        'deductions' => true,
        'bonus' => true,
        'totally_payed' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'salary' => true,
    ];
}
