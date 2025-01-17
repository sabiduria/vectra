<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Accessright Entity
 *
 * @property int $id
 * @property int $profile_id
 * @property int $resource_id
 * @property bool|null $c
 * @property bool|null $r
 * @property bool|null $u
 * @property bool|null $d
 * @property bool|null $p
 * @property bool|null $v
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 * @property bool|null $deleted
 *
 * @property \App\Model\Entity\Profile $profile
 * @property \App\Model\Entity\Resource $resource
 */
class Accessright extends Entity
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
        'profile_id' => true,
        'resource_id' => true,
        'c' => true,
        'r' => true,
        'u' => true,
        'd' => true,
        'p' => true,
        'v' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'deleted' => true,
        'profile' => true,
        'resource' => true,
    ];
}
