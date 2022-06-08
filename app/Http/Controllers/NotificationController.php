<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Repositories\NotificationRepository;

class RoleController extends Controller
{
    protected $notyRepo;

    function __construct(NotificationRepository $notyRepo)
    {
        $this->notyRepo = $notyRepo;
    }
}
