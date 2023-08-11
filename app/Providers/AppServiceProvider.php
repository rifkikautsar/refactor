<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\EloquentAuthRepository;
use App\Repositories\Scan\EloquentScanRepository;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Scan\ScanRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Result\EloquentResultRepository;
use App\Repositories\Survey\EloquentSurveyRepository;
use App\Repositories\Result\ResultRepositoryInterface;
use App\Repositories\Survey\SurveyRepositoryInterface;
use App\Repositories\Article\EloquentArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Diseases\EloquentDiseasesRepository;
use App\Repositories\Diseases\DiseasesRepositoryInterface;
use App\Repositories\PasswordReset\EloquentPasswordResetRepository;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleRepositoryInterface::class, EloquentArticleRepository::class);

        $this->app->bind(DiseasesRepositoryInterface::class, EloquentDiseasesRepository::class);

        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        
        $this->app->bind(SurveyRepositoryInterface::class, EloquentSurveyRepository::class);

        $this->app->bind(AuthRepositoryInterface::class, EloquentAuthRepository::class);

        $this->app->bind(PasswordResetRepositoryInterface::class, EloquentPasswordResetRepository::class);
        
        $this->app->bind(ResultRepositoryInterface::class, EloquentResultRepository::class);
        
        $this->app->bind(ScanRepositoryInterface::class, EloquentScanRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
