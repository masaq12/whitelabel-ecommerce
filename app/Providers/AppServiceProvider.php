<?php

namespace App\Providers;

use App\Models\WhiteLabelSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share white label settings with all views
        try {
            $settings = WhiteLabelSetting::getSettings();
            View::share('settings', $settings);
        } catch (\Exception $e) {
            View::share('settings', new WhiteLabelSetting([
                'site_name'       => 'E-Commerce Store',
                'primary_color'   => '#007bff',
                'secondary_color' => '#6c757d',
            ]));
        }
    }
}
