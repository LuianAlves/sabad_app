<?php

use Illuminate\Support\Facades\Route;

function currentRoute(): array
{
    $currentRoute = Route::currentRouteName();

    if ($currentRoute) {
        $route = explode('.', $currentRoute);

        return $route;
    }

    return [];
}

function currentRouteName(): array
{
    return ['route' => Route::currentRouteName()];
}

