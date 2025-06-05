<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\EventRepository;
use App\Repositories\Repository\EventRepositoryInterface;
use Illuminate\Pagination\Paginator;
use App\Repositories\Eloquent\VolunteerRepository;
use App\Repositories\Repository\VolunteerRepositoryInterface;
use App\Repositories\Eloquent\OrganizationRepository;
use App\Repositories\Repository\OrganizationRepositoryInterface;
use App\Repositories\Repository\NotificationRepositoryInterface;
use App\Repositories\Eloquent\NotificationRepository;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(VolunteerRepositoryInterface::class, VolunteerRepository::class);
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap(); // thêm dòng này nếu chưa có
        config(['qrcode.driver' => 'gd']);

        View::composer('*', function ($view) {
            $topNotifications = collect();
            $unreadNotificationCount = 0;

            if (Auth::guard('volunteer')->check()) {
                $notificationService = app(NotificationService::class);
                $topNotifications = $notificationService->getTopNotificationsForCurrentUser();
                $unreadNotificationCount = $notificationService->getUnreadNotificationCount();
            } elseif (Auth::guard('organization')->check()) {
                $notificationService = app(NotificationService::class);
                $topNotifications = $notificationService->getTopNotificationsForCurrentUser();
                $unreadNotificationCount = $notificationService->getUnreadNotificationCount();
            }

            $view->with('topNotifications', $topNotifications);
            $view->with('unreadNotificationCount', $unreadNotificationCount);
        });
    }
}
