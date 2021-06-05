<?php

namespace RmTop;


use RmTop\command\Publish;
use RmTop\command\SystemRule;
use think\Service;

/**
 */
class RmSysService extends Service
{
    /**
     * Register service.
     *
     * @return void
     */
    public function register()
    {
        // 注册数据迁移服务
        $this->app->register(\think\migration\Service::class);
    }

    /**
     * Boot function.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(['rmtop:sys_publish' => Publish::class,'rmtop:sys_make' => SystemRule::class]);
    }


}
