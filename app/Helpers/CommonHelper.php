<?php

    function currentRoute(): array
    {
        $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();

        if ($currentRoute) {
            $route = explode('.', $currentRoute);
            
            return $route;
        }

        return [];
    }

