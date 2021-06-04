<?php


namespace RmTop\command;

use Exception;
use RmTop\lib\PublishFile;
use RmTop\lib\ScanSysPermission;
use think\Console;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;

class SystemRule extends Console
{

    protected function configure()
    {
        $this->setName('SysRules')
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
        try{
            PublishFile::PublishFileToSys();//发布文件
            $output = Console::call('migrate:run');//执行数据库迁移
            $dirFile = trim($input->getArgument('dirFile'));//文件路径
            $flag = trim($input->getArgument('flag'));//标识
            ScanSysPermission::ScanSys($dirFile,$flag,$output);
        }catch (Exception $exception){
            $output->writeln($exception->getMessage());
        }
    }



}