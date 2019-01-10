<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OptionsService;
use App\Services\BatchService;
use App\Services\InstitutionService;
use App\Services\ModuleService;
use App\Services\SubjectService;
use App\Services\GradeAService;
use App\Services\ActionHistoryService;
use App\Services\CourseService;
use App\Providers\CustomUserProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OptionsService::class, OptionsService::class);
        $this->app->bind(BatchService::class, BatchService::class);
        $this->app->bind(InstitutionService::class, InstitutionService::class);
        $this->app->bind(ModuleService::class, ModuleService::class);
        $this->app->bind(SubjectService::class, SubjectService::class);
        $this->app->bind(GradeAService::class, GradeAService::class);
        $this->app->bind(ActionHistoryService::class, ActionHistoryService::class);
        $this->app->bind(CourseService::class, CourseService::class);
        $this->app->bind(CustomUserProvider::class, function ($app, array $config) {
            return new CustomUserProvider($app['hash'], $app['config']['auth.providers.users.model']);
        });
    }
}
