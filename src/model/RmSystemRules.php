<?php


namespace RmTop\model;


use think\Model;

/**
 * Class app\common\model\RmSystemRules
 *
 * @property int $id
 * @property string $action 方法
 * @property string $controller 控制
 * @property string $file_name 文件位置
 * @property string $flag 目录名称
 * @property string $title 操作描述
 */
class RmSystemRules extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'rm_system_rules';
    // 开启自动写入时间戳字段

}