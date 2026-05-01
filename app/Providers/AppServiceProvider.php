<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }


//     protected $policies = [
//     ConductRecord::class => ConductRecordPolicy::class,
//     IncidentReport::class => IncidentReportPolicy::class,
//     DisciplinaryAction::class => DisciplinaryActionPolicy::class,
//     Assignment::class => AssignmentPolicy::class,
// ];
}
