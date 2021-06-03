<?php


namespace RmTop\model;


use think\Model;

/**
 * Class app\common\model\RmRoleModel
 *
 * @property int $id
 * @property string $role_sym 角色标识
 * @property string $role_title 角色名称
 */
class RmRoleModel extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'rm_roles';
    // 开启自动写入时间戳字段
}