<?php

namespace App\Support;

use App\Models\Branch;
use App\Models\DailyTask;

class DefaultDailyTasks
{
    public static function all(): array
    {
        return [
            ['name' => 'Clean Machines & Work Area', 'requires_photo' => true],
            ['name' => 'Machine Counter Reading', 'requires_photo' => true],
            ['name' => 'Trash Disposal', 'requires_photo' => true],
            ['name' => 'Store Closing Check', 'requires_photo' => true],
        ];
    }

    public static function seedForBranch(Branch $branch): void
    {
        foreach (self::all() as $task) {
            DailyTask::firstOrCreate(
                ['branch_id' => $branch->id, 'name' => $task['name']],
                ['requires_photo' => $task['requires_photo'], 'is_active' => true]
            );
        }
    }
}
