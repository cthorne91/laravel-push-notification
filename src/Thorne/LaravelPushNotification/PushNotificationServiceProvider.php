<?php 

namespace Thorne\LaravelPushNotification;

use Illuminate\Support\ServiceProvider;
use Thorne\LaravelPushNotification\PushNotificationBuilder;

class PushNotificationServiceProvider extends ServiceProvider 
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    	$this->app->bind(
            'Thorne\LaravelPushNotification\PushNotificationBuilder',
            'Thorne\LaravelPushNotification\PushNotifier'
        );

        $this->publishes([
        	__DIR__ . '/../../config/config.php' 					=> config_path('pushnotification.php'),
        	__DIR__ . '/../../config/ios-certificates/development'  => config_path('ios-push-notification-certificates/development'),
        	__DIR__ . '/../../config/ios-certificates/production' 	=> config_path('ios-push-notification-certificates/production')
    	]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('push_notification_thorne', function ($app) {
            return new PushNotificationBuilder;
        }); 
    }
}
