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
        if (file_exists($routes = $this->routePath())) {
            $this->loadRoutesFrom($routes);
        }
        if (file_exists($routes = base_path('routes/jauth.php'))) {
            $this->loadRoutesFrom($routes);
        }

        //注册resources
        $this->loadViewsFrom($this->viewPath(), 'jauth');
        $this->loadTranslationsFrom(__DIR__ . '/path/to/translations', 'jauth');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('jauth.php')], 'jauth-config');
            $this->publishes([$this->routePath() => base_path('routes/jauth.php')], 'jauth-routes');
            // $this->publishes([$this->migrationPath() =>database_path('migrations')], 'jauth-migrate');
            $this->publishes([
                $this->langPath() => resource_path('lang/vendor/jauth'),
                $this->viewPath() => resource_path('views/vendor/jauth')
            ], "jauth-resources");
        }
    }

    /**
     * Get the config path
     *
     * @return string
     */
    protected function configPath()
    {
        return __DIR__ . '/../config/jauth.php';
    }
    /**
     * Get the routes path
     *
     * @return string
     */
    protected function routePath()
    {
        return __DIR__ . '/../routes/jauth.php';
    }
    /**
     * Get the migrations path
     *
     * @return string
     */
    protected function migrationPath()
    {
        return __DIR__ . '/../migrations/';
    }
    /**
     * Get the resources path
     *
     * @return string
     */
    protected function resourcesPath()
    {
        return __DIR__ . '/../resources/';
    }
    /**
     * Get the lang path
     *
     * @return string
     */
    protected function langPath()
    {
        return $this->resourcesPath() . "lang/";
    }
    /**
     * Get the view path
     *
     * @return string
     */
    protected function viewPath()
    {
        return $this->resourcesPath() . "views/";
    }
}
