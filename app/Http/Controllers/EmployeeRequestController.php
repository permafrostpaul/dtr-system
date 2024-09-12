<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LeaveRequestNotification;

class EmployeeRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendingRequests = LeaveRequest::where('status', 'pending')->get();
        $acceptedRequests = LeaveRequest::where('status', 'accepted')->get();
        $declinedRequests = LeaveRequest::where('status', 'declined')->get();

        // Optionally, filter these requests by the current user if needed
        // $pendingRequests = $user->leaveRequests()->where('status', 'pending')->get();

        return view('profile.admin.employee-request', compact('user', 'pendingRequests', 'acceptedRequests', 'declinedRequests'));
    }

    public function pendingRequests()
    {
        $pendingRequests = LeaveRequest::where('status', 'pending')->get();
        return view('leave-requests.pending', compact('pendingRequests'));
    }

    public function acceptRequest($id)
    {
        $leaveRequest = LeaveRequest::find($id);

        if ($leaveRequest) {
            $leaveRequest->status = 'accepted';
            $leaveRequest->save();

            // Get the admin user who accepted the request
            $admin = Auth::user();

            // Notify the employee
            $user = $leaveRequest->user; // Ensure this relationship exists in your LeaveRequest model
            $user->notify(new LeaveRequestNotification('accepted', $admin, $leaveRequest));
        }

        return redirect()->back()->with('status', 'Leave request accepted successfully.');
    }
    public function declineRequest($id)
    {
        $leaveRequest = LeaveRequest::find($id);

        if ($leaveRequest) {
            $leaveRequest->status = 'declined';
            $leaveRequest->save();

            // Notify the user with detailed message
            $admin = Auth::user(); // Assuming the admin is the currently logged-in user
            $user = $leaveRequest->user; // Ensure this relationship exists in your model
            $user->notify(new LeaveRequestNotification('declined', $admin, $leaveRequest));
        }

        return redirect()->back()->with('status', 'Leave request declined successfully.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $pendingRequests = LeaveRequest::where('status', 'pending')
            ->where(function ($q) use ($query) {
                $q->whereHas('user', function ($q) use ($query) {
                    $q->where('firstname', 'like', "%$query%")
                        ->orWhere('lastname', 'like', "%$query%")
                        ->orWhere('email', 'like', "%$query%");
                })->orWhere('leave_number', 'like', "%$query%");
            })
            ->get();

        $acceptedRequests = LeaveRequest::where('status', 'accepted')
            ->where(function ($q) use ($query) {
                $q->whereHas('user', function ($q) use ($query) {
                    $q->where('firstname', 'like', "%$query%")
                        ->orWhere('lastname', 'like', "%$query%")
                        ->orWhere('email', 'like', "%$query%");
                })->orWhere('leave_number', 'like', "%$query%");
            })
            ->get();

        $declinedRequests = LeaveRequest::where('status', 'declined')
            ->where(function ($q) use ($query) {
                $q->whereHas('user', function ($q) use ($query) {
                    $q->where('firstname', 'like', "%$query%")
                        ->orWhere('lastname', 'like', "%$query%")
                        ->orWhere('email', 'like', "%$query%");
                })->orWhere('leave_number', 'like', "%$query%");
            })
            ->get();

        return view('profile.admin.employee-request', [
            'pendingRequests' => $pendingRequests,
            'acceptedRequests' => $acceptedRequests,
            'declinedRequests' => $declinedRequests,
        ]);
    }
}
