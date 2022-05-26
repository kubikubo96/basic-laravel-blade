<?php

namespace App\Repositories;

use App\Models\BillCassoLog;

class BillCassoLogRepository extends EloquentRepository
{
    public function getModel(): string
    {
        return BillCassoLog::class;
    }
}
