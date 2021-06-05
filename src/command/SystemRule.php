<?php


namespace RmTop\command;

use Exception;
use RmTop\lib\PublishFile;
use RmTop\lib\ScanSysPermission;
use think\Console;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;

class SystemRule extends Command
{
    protected function configure()
    {
        $this->setName('rm_top:sys_make')
            ->addArgument('dirFile', Argument::OPTIONAL, "file dir")//扫描路径
            ->addArgument('flag', Argument::OPTIONAL, "flag")//
            ->setDescription('创建系统规则');
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
            $dirFile = trim($input->getArgument('dirFile'));//文件路径
            $flag = trim($input->getArgument('flag'));//标识
            ScanSysPermission::ScanSys($dirFile,$flag,$output);
        }catch (Exception $exception){
            $output->writeln($exception->getMessage());
        }
    }



}