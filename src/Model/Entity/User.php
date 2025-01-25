<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $address
 * @property string|null $phone1
 * @property string|null $phone2
 * @property float|null $leave_days_month
 * @property string|null $employeetype
 * @property string|null $username
 * @property string|null $password
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Affectation[] $affectations
 * @property \App\Model\Entity\Leave[] $leaves
 * @property \App\Model\Entity\Leavesbalance[] $leavesbalances
 * @property \App\Model\Entity\Salary[] $salaries
 * @property \App\Model\Entity\Sale[] $sales
 */
class User extends Entity
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
        'firstname' => true,
        'lastname' => true,
        'address' => true,
        'phone1' => true,
        'phone2' => true,
        'leave_days_month' => true,
        'employeetype' => true,
        'username' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'affectations' => true,
        'leaves' => true,
        'leavesbalances' => true,
        'salaries' => true,
        'sales' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
