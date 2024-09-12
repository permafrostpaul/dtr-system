<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCalendarController extends Controller
{
    public function index()
    {
        return view('profile.admin.admin-calendar');
    }
}
