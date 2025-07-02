<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class GenericModelObserver
{
    protected array $originals = [];

    public function updating(Model $model)
{
    $this->originals[spl_object_hash($model)] = $model->getOriginal();
    \Illuminate\Support\Facades\Log::info('Observer updating - original:', $this->originals[spl_object_hash($model)]);
}


    public function created(Model $model)
    {
        $this->log($model, 'created');
    }

    public function updated(Model $model)
    {
        $this->log($model, 'updated');
        // Apaga os dados originais salvos para liberar memória
        unset($this->originals[spl_object_hash($model)]);
    }

    public function deleted(Model $model)
    {
        $this->log($model, 'deleted');
    }

    protected function log(Model $model, string $action)
    {
        $user = Auth::user();
        $typeName = class_basename($model);
        $modelName = method_exists($model, 'getDisplayName')
            ? $model->getDisplayName()
            : ($model->name ?? $model->title ?? "ID {$model->id}");

        $description = match ($action) {
            'created' => "O {$typeName} \"{$modelName}\" foi criado",
            'deleted' => "O {$typeName} \"{$modelName}\" foi removido",
            'updated' => $this->buildUpdateDescription($model, $typeName, $modelName),
            default   => "Ação desconhecida",
        };

        $description .= $user
            ? " pelo usuário \"{$user->name}\""
            : " por um usuário não autenticado";

        ActivityLog::create([
            'user_id'     => $user?->id,
            'model_type'  => get_class($model),
            'model_id'    => $model->id,
            'action'      => $action,
            'description' => $description,
            'diff'        => $action === 'updated' ? $this->getDiffDataUsingOriginal($model) : null,
        ]);
    }

    protected function buildUpdateDescription(Model $model, string $typeName, string $modelName): string
    {
        $changes = [];

        foreach ($model->getChanges() as $field => $new) {
            $old = $model->getOriginal($field);
            if ($old != $new) {
                $changes[] = "{$field}: de \"{$old}\" para \"{$new}\"";
            }
        }

        $changeText = count($changes) > 0
            ? 'Alterações: ' . implode(', ', $changes)
            : 'Sem alterações relevantes';

        return "O {$typeName} \"{$modelName}\" foi editado. {$changeText}";
    }

    protected function getDiffDataUsingOriginal(Model $model): ?array
    {
        $original = $this->originals[spl_object_hash($model)] ?? $model->getOriginal();
        $current = $model->getAttributes();

        $diff = [];
        foreach ($current as $field => $newValue) {
            if (!array_key_exists($field, $original)) {
                continue;
            }

            $oldValue = $original[$field];

            if ($oldValue != $newValue) {
                $diff[$field] = [
                    'old' => $oldValue,
                    'new' => $newValue,
                ];
            }
        }

        return count($diff) > 0 ? $diff : null;
    }
}
