<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/3
 * Time: 11:15 下午
 */
namespace RmTop\sys;
use RmTop\model\RmSystemRules;

class SysRules
{


    /**
     * 创建系统规则
     * @param string $controller  控制器
     * @param string $action  方法
     * @param string $fileName  文件位置
     * @param string $flag  标识
     * @param string $DocComment  方法描述
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    static  function create_sys_rule(string $controller,string $action,string $fileName,string $flag,string $DocComment){
        if(!RmSystemRules::where(['controller'=>$controller,'action'=>$action,'flag'=>$flag])->find())
            RmSystemRules::create([
                'controller'=>$controller,
                'action'=>$action,
                'file_name'=>$fileName,
                'flag'=>$flag,
                'title'=>$DocComment
            ]);
    }

}