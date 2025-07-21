<?php

namespace Jazer\Pasakay\Http\Provider;

use Illuminate\Support\ServiceProvider;

class PasakayServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../config/database.php', 'jtpasakayconfig'  
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../../config/config.php' => config_path('jtpasakayconfig.php')
        ], 'jtpasakayconfig-config');
        
        $this->loadRoutesFrom( __DIR__ . '/../../../routes/api.php');

        config(['database.connections.conn_pasakay' => config('jtpasakayconfig.database_connection')]);
    }
}
