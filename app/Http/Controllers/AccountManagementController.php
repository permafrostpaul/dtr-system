<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountManagementController extends Controller
{
    public function index() 
    {
        // Fetch all users with role 'admin'
        $admins = User::where('role', 'admin')->get();

        // Fetch all users with pending status
        $pendingAccounts = User::where('status', 'pending')->get();

        // Pass the data to the view
        return view('profile.admin.manage-account', compact('admins', 'pendingAccounts'));
    }
}
