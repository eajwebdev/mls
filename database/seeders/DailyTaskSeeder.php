<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Support\DefaultDailyTasks;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DailyTaskSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('daily_tasks')) {
            return;
        }

        Branch::query()->each(fn (Branch $branch) => DefaultDailyTasks::seedForBranch($branch));
    }
}
