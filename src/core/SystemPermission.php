<?php


namespace RmTop\core;

use RmTop\model\RmRoleModel;
use tauthz\facade\Enforcer;

/**
 * 系统权限
 * Class Permission
 * @package
 */

class SystemPermission
{

    /**
     * 判断某个角色或者用户是否 拥有某个权限
     * @param string $user
     * @param string $service
     * @param string $action
     * @return bool
     */
    static  function checkPermissionForUser(string $user,string $service,string $action): bool
    {
        // to check if a user has permission
        if(Enforcer::enforce($user, $service, $action)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param string $role_name
     * @param string $role_symbol
     * @param string $role_org_img
     * @return RmRoleModel|\think\Model |\think\Model
     */
    static function createRole(string $role_name,string $role_symbol,string $role_org_img = ''){
        return RmRoleModel::create([
            'role_name'=>$role_name,
            'role_sym'=>$role_symbol,
            'role_org_img'=>$role_org_img,
        ]);
    }


    /**
     * 获取系统角色列表
     * @param array $where
     * @param int $limit
     * @return RmRoleModel|\think\Paginator
     * @throws \think\db\exception\DbException
     */
    static function getRoleList(array  $where = [],$limit = 10){
        if($where){
            return RmRoleModel::where($where)->paginate($limit);
        }else{
            return RmRoleModel::where(1)->paginate($limit);
        }
    }


    /**
     * 删除角色
     * @param string $role
     * @return bool
     */
    static function deleteRole(string $role): bool
    {
        Enforcer::deleteRole($role);
        return RmRoleModel::where(['role_sym'=>$role])->delete();
    }


    /**
     * 为某个角色 添加某个业务下的 某个权限
     * @param string $role 角色标识符
     * @param string $service   //操作类目
     * @param string $action  //操作方法
     */
    static function addPermissionForRole(string $role,string $service,string $action){
        Enforcer::addPolicy($role,$service,$action);
    }


    /**
     *获取某个角色下的所有权限
     * @param string $role
     * @return mixed
     */
    static  function getPermissionForRole(string  $role){
        return   Enforcer::getPermissionsForUser($role); // return array
    }


    /**
     * 删除某个角色的--某个类目的 --谋个操作权限
     * @param string $role
     * @param string $service
     * @param string $action
     *
     */
    static function deletePermissionFromRole(string $role,string $service,string $action){
        Enforcer::removePolicy($role, $service, $action);
    }


    /**
     * @param string $role
     * 删除某个角色的所有权限
     */
    static function deleteAllPermissionFromRole(string $role){
        Enforcer::deletePermissionsForUser($role);
    }


    /**
     * 为某个用户，添加上某个角色
     * @param string $user
     * @param string $role
     */
    static function addRoleForUser(string $user,string $role){
        Enforcer::addRoleForUser($user,$role);
    }


    /**
     * 删除某个用户的 某个角色
     * @param string $user
     * @param string $role
     */
    static function deleteOneRoleForUser(string $user,string $role){
        Enforcer::deleteRoleForUser($user, $role);
    }


    /**
     * 删除用户的所有角色
     * @param string $user
     *
     */
    static function deleteAllRoleForUser(string $user){
        Enforcer::deleteRolesForUser($user);
    }


    /**
     *获取某个用户下的所有权限
     * @param string $role
     * @return mixed
     */
    static  function getPermissionForUser(string  $role){
        return   Enforcer::getImplicitPermissionsForUser($role); // return array
    }


    /**
     * @param string $username
     * @return mixed
     * 获取某个用户的所有角色
     */
    static  function getRoleForUser(string  $username){
        return   Enforcer::getImplicitRolesForUser($username); // return array
    }

}