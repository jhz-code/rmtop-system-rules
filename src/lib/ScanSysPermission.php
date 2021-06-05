<?php


namespace RmTop\lib;


use ReflectionClass;
use RmTop\sys\SysRules;

class ScanSysPermission
{


    /**
     * 扫描系统权限
     * @param $dirFile
     * @param $flag
     * @param $output
     * @throws \ReflectionException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    static function ScanSys($dirFile,$flag,$output){
        $filePath = app_path().$dirFile;
        $dir = scandir(app_path().$dirFile);
        foreach ($dir as $key=>$value){
            if(is_file($filePath.'/'.$value)){
                $class = FileLoad::get_class_from_file($filePath."/".$value);
                $reflect = new ReflectionClass($class);
                //获取父级别方法
                $parentMethod = [] ;
                if($reflect->getParentClass()){
                    $parentMethod = $reflect->getParentClass()->getMethods();
                }
                $method = array_diff($reflect->getMethods(),$parentMethod);//获取子类方法
                self::makeRole($reflect->getShortName(),$method,$parentMethod,$reflect->getFileName(),$flag,$output);
            }
        }
    }




    /**
     * 创建系统操作权限
     * @param string $ctr_role
     * @param array $action
     * @param array $parentAction
     * @param string $fileName
     * @param $flag
     * @param $output
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
  static  function makeRole(string $ctr_role, array $action,array $parentAction,string $fileName, $flag, $output){
        foreach ($action as $item=>$value){
            if(!in_array($value,$parentAction)){
                $r = (new DocParser())->parse($value->getDocComment());
                $doc = isset($r['description'])?$r['description']:"-";
                SysRules::create_sys_rule($ctr_role,$value->name,$fileName,$flag,$doc);
                $output->writeln("[$item]:$ctr_role --- $value->name --- $doc --- successfully");
            }
        }
    }


}