<?php

declare(strict_types=1);

use App\Controller\SiteController;
use Yiisoft\Composer\Config\Merger\Modifier\ReverseBlockMerge;
use Yiisoft\Router\Route;

return [
    // Lonely pages of site
    Route::get('/', [SiteController::class, 'index'])
        ->name('site/index'),
    //Route::get('/', [SiteController::class, 'index'])->name('home'),
    ReverseBlockMerge::class => new ReverseBlockMerge(),
];
