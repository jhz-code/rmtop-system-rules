<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/4
 * Time: 10:55 下午
 */


namespace RmTop\command;


use RmTop\lib\PublishFile;
use RmTop\lib\ScanSysPermission;
use think\Console;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\Exception;

class Publish extends Command
{


    protected function configure()
    {
        $this->setName('rm_top:sys_publish')
            ->setDescription('发布系统规则文件');
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
            PublishFile::PublishFileToSys($output);//发布文件
            $output->writeln("all publish successfully！");
        }catch (Exception $exception){
            $output->writeln($exception->getMessage());
        }
    }


}