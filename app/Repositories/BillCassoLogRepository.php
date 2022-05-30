<?php

namespace App\Repositories;

use App\Models\BillCassoLog;

class BillCassoLogRepository extends BaseRepository
{
    public function getModel(): string
    {
        return BillCassoLog::class;
    }
}
