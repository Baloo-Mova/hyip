<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        URL::forceScheme('https');

        \View::addNamespace('Admin', resource_path('admin'));

        \View::share([
            'base_url'       => preg_replace('#\/index.php\/?#is', '/', url('/')),
            'base_js_url'    => preg_replace('#\/index.php\/?#is', '/', url('/js')),
            'base_css_url'   => preg_replace('#\/index.php\/?#is', '/', url('/css')),
            'images_css_url' => preg_replace('#\/index.php\/?#is', '/', url('/images')),
            'user'           => ( \Auth::check() ) ? \Auth::user() : false,
            'current_uri'    => \Request::path(),
        ]);

        \Schema::defaultStringLength(191);

        \Form::macro('customButton', function($text, $buttonClass, $faClass)
        {
            return '<button class="' . $buttonClass . '">
                    <i class="fa ' . $faClass . '" aria-hidden="true"></i>
                    &nbsp;&nbsp;
                    ' . $text . '
                </button>';
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
