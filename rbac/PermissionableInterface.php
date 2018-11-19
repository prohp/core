<?php
namespace app\common\rbac;

/**
 * Interface PermissionableInterface
 *
 *
 *
 * 
 */
interface PermissionableInterface
{
    /**
     * Разрешена ли текущему пользователю привилегия(ии)
     *
     * @param string|string[]|null $privilege
     * @param bool                 $allowCaching
     * @return bool
     */
    public function can($privilege = null, $allowCaching = true);

    /**
     * Разрешить роли(ям) привилегию(ии)
     *
     * @param string|string[]      $role
     * @param string|string[]|null $privilege
     */
    public function allow($role, $privilege = null);

    /**
     * Запретить роли(ям) привилегию(ии)
     *
     * @param string|string[]      $role
     * @param string|string[]|null $privilege
     */
    public function deny($role, $privilege = null);
}
