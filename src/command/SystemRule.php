<?php


namespace RmTop\command;

use Exception;
use ReflectionClass;
use RmTop\lib\DocParser;
use RmTop\lib\FileLoad;
use RmTop\lib\PublishFile;
use RmTop\lib\ScanSysPermission;
use RmTop\sys\SysRules;
use tauthz\command\Publish;
use think\Console;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;

class SystemRule extends Console
{

    protected function configure()
    {
        $this->setName('SysRules::publish')
            ->addArgument('dirFile', Argument::OPTIONAL, "file dir")//扫描路径
            ->addArgument('flag', Argument::OPTIONAL, "flag")//
            ->setDescription('role-Make');
    }


    /**
     * 执行数据
     * @param Input $input
     * @param Output $output
     * @return int|void|null
     */
    protected function execute(Input $input, Output $output)
    {

        PublishFile::PublishFileToSys();//发布文件
        $output = Console::call('migrate:run');//执行数据库迁移
        $dirFile = trim($input->getArgument('dirFile'));
        $flag = trim($input->getArgument('flag'));





        $filePath = app_path().$dirFile;
        try{
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
                    $this->makeRole($reflect->getShortName(),$method,$parentMethod,$reflect->getFileName(),$flag,$output);
                }
            }
            $output->writeln("make successfully ");
        }catch (Exception $exception){
            $output->writeln($exception->getMessage());
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
    function makeRole(string $ctr_role, array $action,array $parentAction,string $fileName, $flag, $output){
        foreach ($action as $item=>$value){
            if(!in_array($value,$parentAction)){
                $r = (new DocParser())->parse($value->getDocComment());
                $doc = isset($r['description'])?$r['description']:"无备注";
                SysRules::create_sys_rule($ctr_role,$value->name,$fileName,$flag,$doc);
                $output->writeln("[$item]:$ctr_role --- $value->name --- $doc --- successfully");
            }
        }
    }


}