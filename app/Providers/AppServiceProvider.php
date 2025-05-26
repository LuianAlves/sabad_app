<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Dependences
use Illuminate\Support\Facades\File;
use App\Contracts\Auditable;
use App\Observers\GenericModelObserver;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $modelPath = app_path('Models');

        collect(File::allFiles($modelPath))
            ->map(function ($file) use ($modelPath) {
                $relativePath = Str::replaceFirst($modelPath . DIRECTORY_SEPARATOR, '', $file->getPathname());

                $class = 'App\\Models\\' . str_replace(['/', '\\', '.php'], ['\\', '\\', ''], $relativePath);

                return $class;
            })
            ->filter(function ($class) {
                return class_exists($class)
                    && in_array(Auditable::class, class_implements($class));
            })
            ->each(function ($auditableClass) {
                $auditableClass::observe(GenericModelObserver::class);
                logger("Observer registrado para: {$auditableClass}");
            });
    }
}
