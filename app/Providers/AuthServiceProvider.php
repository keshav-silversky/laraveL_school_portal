<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate as FacadesGate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Progress' => 'App\Policies\ProgressPolicy',
        'App\Models\Payment' => 'App\Policies\PaymentPolicy',
        'App\Payment' => 'App\Policies\HomePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-enrolled', function ($user, $course) {
            if ($user->enroll()->where('course_id', $course->id)->exists()) {
                return true;
            }
        });
  

        //
    }
}
