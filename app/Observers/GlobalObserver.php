<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Tool;
use App\Models\Category;
use App\Models\ToolUnit;
use App\Models\User;

class GlobalObserver
{
    public function created($model)
    {
        $this->log('DiBuat', $model);
    }

    public function updated($model)
    {
        $this->log('DiUpdate', $model);
    }

    public function deleted($model)
    {
        $this->log('DiHapus', $model);
    }

    private function log($action, $model)
    {
        // ambil nama model (tools, users, dll)
        $module = strtolower(class_basename($model));

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $module . '.' . $action,
            'module' => $module,
            'description' => ucfirst($action) . ' ' . $module . ': ' . ($model->name ?? $model->id),
            'meta' => json_encode($model->toArray()),
            'ip_address' => request()->ip(),
            'created_at' => now()
        ]);
    }
}