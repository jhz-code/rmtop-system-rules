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


    protected $table;

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;

    public function __construct(array $data = [])
    {
        $this->table = env('database.prefix', '')."sys_rule";
        parent::__construct($data);
    }

}