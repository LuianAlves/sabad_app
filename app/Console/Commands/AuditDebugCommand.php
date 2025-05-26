<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Contracts\Auditable;

class AuditDebugCommand extends Command
{
    protected $signature = 'audit:debug';
    protected $description = 'Lista todos os models que implementam Auditable e confirma se são válidos';

    public function handle()
    {
        $modelPath = app_path('Models');
        $this->info("📦 Procurando models com Auditable em: $modelPath\n");

        $models = collect(File::allFiles($modelPath))
            ->map(function ($file) use ($modelPath) {
                $relativePath = Str::replaceFirst($modelPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                return 'App\\Models\\' . str_replace(['/', '\\', '.php'], ['\\', '\\', ''], $relativePath);
            })
            ->filter(function ($class) {
                return class_exists($class) && in_array(Auditable::class, class_implements($class));
            });

        if ($models->isEmpty()) {
            $this->warn('⚠️ Nenhum model com Auditable encontrado.');
            return;
        }

        $this->info('✅ Models Auditable encontrados:');
        $models->each(function ($model) {
            $this->line("  - $model");
        });

        $this->info("\n🟢 Para que os observers funcionem, verifique se o método boot() do AppServiceProvider está corretamente configurado.");
    }
}
