<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\CustomConfigProvider::class,
    App\Providers\FileStorageCustomConfigProvider::class,
    App\Providers\FortifyServiceProvider::class,
    App\Providers\JetstreamServiceProvider::class,
    App\Providers\PermissionServiceProvider::class,
    Froiden\LaravelInstaller\Providers\LaravelInstallerServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Macellan\Zip\ZipServiceProvider::class,
];
