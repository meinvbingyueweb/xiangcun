<?php

namespace App\Providers;

use App\Models\NovelChaptModel;
use App\Models\NovelModel;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * 后台模型
         */
        $this->app->bind('AdminUserModel',AdminUser::class);
        $this->app->bind('AdminMenuModel',Menu::class);

        /*
         * 小说模型
         */
        $this->app->bind('NovelModel',NovelModel::class);
        $this->app->bind('NovelChaptModel',NovelChaptModel::class);
    }

    public function provides()
    {
        return [
            'AdminUserModel',
            'AdminMenuModel',
            'NovelModel',
            'NovelChaptModel',
        ];
    }
}
