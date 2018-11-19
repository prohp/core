<?php
namespace app\common\acl\resource;

/**
 * Interface ApplicationResourceInterface
 * @package app\common\acl\resource
 */
interface ApplicationResourceInterface extends ResourceInterface
{
    public function isAllowed($privilege, $_ = null);
    public function aclAlias();
    public function getPrivileges();
    public function setProprietary($rule);
    public function getProprietary();
}
