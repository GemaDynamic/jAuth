<?php

namespace Junyan\Auth;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // //注册单例
        // $this->app->alias(Auth::class, "auth");
        //注册配置
        $this->mergeConfigFrom($this->configPath(), 'jauth');
        //注册路由
        if (file_exists($routes = __DIR__ . "/route.php")) {
            $this->loadRoutesFrom($routes);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('jauth.php')], 'jauth');
            $this->publishes([$this->routePath() => base_path('routes')], 'jauth');
        }
    }

    /**
     * Set the config path
     *
     * @return string
     */
    protected function configPath()
    {
        return __DIR__ . '/../config/jauth.php';
    }
    /**
     * Set the routes path
     *
     * @return string
     */
    protected function RoutePath()
    {
        return __DIR__ . '/routes/jauth.php';
    }
}
