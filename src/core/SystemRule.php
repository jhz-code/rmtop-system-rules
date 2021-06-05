<?php


namespace RmTop\core;


use RmTop\model\RmSystemRules;

class SystemRule
{

    /**
     * 获取系统规则列表
     * @param array $where
     * @param int $limit
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
   static  function getSystemRuleList(array  $where = [],$limit = 10): \think\Paginator
    {
        if($where){
            return RmSystemRules::where($where)->paginate($limit);
        }else{
            return RmSystemRules::where(1)->paginate($limit);
        }
    }


    /**
     * 删除某条规则
     * @param int $rule_id
     * @return bool
     */
    static function deleteOneRule(int $rule_id): bool
    {
        return RmSystemRules::where(['id'=>$rule_id])->delete();
    }


    /**
     * 设置规则状态
     * @param int $rule_id
     * @param $state
     * @return RmSystemRules
     */
    static function setRuleState(int $rule_id,$state){
        return RmSystemRules::where(['id'=>$rule_id])->update(['status'=>$state]);
    }


    /**
     * 确认规则状态
     * @param string $flag
     * @param string $controller
     * @param string $action
     * @return mixed
     */
    static function checkState(string $flag,string $controller,string $action){
        return RmSystemRules::where(['flag'=>$flag,'controller'=>$controller,'action'=>$action])->value("status");
    }

}