<?php
/*
 *          ┌─┐       ┌─┐
 *       ┌──┘ ┴───────┘ ┴──┐
 *       │                 │
 *       │       ───       │
 *       │  ─┬┘       └┬─  │
 *       │                 │
 *       │       ─┴─       │
 *       └───┐         ┌───┘
 *           │         └──────────────┐
 *           │                        ├─┐
 *           │                        ┌─┘
 *           │                        │
 *           └─┐  ┐  ┌───────┬──┐  ┌──┘
 *             │ ─┤ ─┤       │ ─┤ ─┤
 *             └──┴──┘       └──┴──┘
 *  @Author Ethan <ethan@brayun.com>
 */

namespace Brayun\Administration;

use Brayun\Foundation\Module\Module;

class UcenterServiceProvider extends Module
{

    protected $commands = [
        'Brayun\Administration\Console\InstallCommand'
    ];

    protected $routeMiddleware = [

    ];

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'admin');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');


        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => config_path()]);
            $this->publishes([__DIR__ . '/../resources/lang' => resource_path('lang/vendor/admin')]);
            $this->publishes([__DIR__ . '/../databases/migrations' => database_path('migrations')]);
        }

        $configFile = config_path('admin.php');
        if (file_exists($configFile)) {
            $this->mergeConfigFrom($configFile, 'admin');
        }

    }

    /**
     * 注册服务
     */
    public function register()
    {
        $this->registerRouteMiddleware();

        $this->commands($this->commands);
    }

    /**
     * 注册路由中间件
     */
    protected function registerRouteMiddleware()
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }
    }
}