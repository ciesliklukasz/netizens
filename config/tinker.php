<?php

use App\Console\Commands\Album\AlbumDelete;
use App\Console\Commands\Album\AlbumDeletePictures;
use App\Console\Commands\Album\AlbumShow;
use App\Console\Commands\Album\AlbumUpdate;
use App\Console\Commands\Picture\PictureImport;
use App\Console\Commands\Picture\PictureUpdate;

return [

    /*
    |--------------------------------------------------------------------------
    | Console Commands
    |--------------------------------------------------------------------------
    |
    | This option allows you to add additional Artisan commands that should
    | be available within the Tinker environment. Once the command is in
    | this array you may execute the command in Tinker using its name.
    |
    */

    'commands' => [
        PictureImport::class,
        PictureUpdate::class,
        AlbumUpdate::class,
        AlbumShow::class,
        AlbumDeletePictures::class,
        AlbumDelete::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Alias Blacklist
    |--------------------------------------------------------------------------
    |
    | Typically, Tinker automatically aliases classes as you require them in
    | Tinker. However, you may wish to never alias certain classes, which
    | you may accomplish by listing the classes in the following array.
    |
    */

    'dont_alias' => [
        'App\Nova',
    ],

];
