<?php

namespace RmTop;


use Casbin\Bridge\Logger\LoggerBridge;
use RmTop\command\SystemRule;
use think\facade\Log;
use think\Service;

/**
 * Tauthz service.
 *
 * @author techlee@qq.com
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

        // 绑定 Casbin决策器
        $this->app->bind('rmtopsys', function () {
            $default = $this->app->config->get('rmtop.default');
        });
    }

    /**
     * Boot function.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/rmtop.php', 'rmtop');

        // 设置 Casbin Logger
        if ($logger = $this->app->config->get('rmtop.log.logger')) {
            if (is_string($logger)) {
                $logger = $this->app->make($logger);
            }

            Log::setLogger(new LoggerBridge($logger));
        }

        $this->commands(['SysRules:publish' => SystemRule::class]);
    }

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param string $path
     * @param string $key
     *
     * @return void
     */
    protected function mergeConfigFrom(string $path, string $key)
    {
        $config = $this->app->config->get($key, []);

        $this->app->config->set(array_merge(require $path, $config), $key);
    }
}
