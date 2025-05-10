<?php

namespace App\Services;

use App\Models\User;
use App\Models\LeaveRequest;

use Illuminate\Http\Request;
use App\Policies\LeaveRequestPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Notifications\LeaveRequestNotification;
use App\Notifications\RejectLeaverequestNotification;
use App\Notifications\ApproveLeaverequestHrNotification;

class LeaveManagementService
{
    public function  __construct() {}


    //** show all main requests */
    public function  showAll()
    {
        Gate::authorize('viewAny', LeaveRequest::class);
        $user = Auth::user();
        return LeaveRequest::where('user_id', $user->id)->get();
    }

    //** show  request */
    public function  show($id)

    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        Gate::authorize('view', $leaveRequest);

        return  $leaveRequest;
    }


    //** create  request */
    public function  create(Request $request)
    {
        $user = Auth::user();

        Gate::authorize('create', LeaveRequest::class);
        if ($user->manager_id == null) {
            return response()->json([
                'message' => 'you dont have direct manager',
            ], 422);
        }
        $request = LeaveRequest::create([
            'user_id' => $user->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            "reviewed_by" => $user->manager_id,
        ]);

        $user->manager->notify(new LeaveRequestNotification($request));
    }


    //** show request to review  */
    public function  showAllReviews()
    {
        $user = Auth::user();
        return LeaveRequest::where('reviewed_by', $user->id)->get();
    }


    //** review request by approve or  reject  */
    public function reviewRequest(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::find($id);

        Gate::authorize('reviewRequest', $leaveRequest);
        $user = User::find($leaveRequest->user_id);
        if ($request->status == 'approved') {
            $leaveRequest->status = 'approved';
            $leaveRequest->save();
            User::where("role", "hr")->get()->each(function ($user) use ($leaveRequest) {
                $user->notify(new ApproveLeaverequestHrNotification($leaveRequest));
                // notify to all hr user
            });
        } else {
            $leaveRequest->status = 'rejected';
            $leaveRequest->save();
            $user->notify(new RejectLeaverequestNotification($leaveRequest));
            // notify to user that send the request
        }
        return $leaveRequest;
    }

    //**  show by hr if approveed */

    public function showRequestsForHr()
    {
        return LeaveRequest::where('status', "approved")->orderBy("updated_at", "desc")->get();
    }
}
