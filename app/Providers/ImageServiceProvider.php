<?php

/*
* Author: Miguel Salinas
*/

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Util\ImageGCPStorage;
use App\Util\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, function ($app, $params) {
            $storage_type = $params['storage'];

            if ($storage_type == 'local') {
                return new ImageLocalStorage;
            }

            if ($storage_type == 'gcp') {
                return new ImageGCPStorage;
            }
        });
    }
}
