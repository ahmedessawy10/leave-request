<?php

namespace App\Http\Controllers\Api;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveRequestResource;
use App\Notifications\LeaveRequestNotification;
use App\Services\LeaveManagementService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct(private LeaveManagementService $leaveService)
    {
        $leaveService = new LeaveManagementService();
    }
    public function index()
    {
        $leaveRequests = $this->leaveService->showAll();
        return LeaveRequestResource::collection($leaveRequests);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'reason' => 'required',
            "start_date" => "required",
            "end_date" => "required",
        ]);

        $this->leaveService->create($request);

        return response()->json([
            'message' => 'Leave request created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


        $leaveRequest = $this->leaveService->show($id);
        return new LeaveRequestResource($leaveRequest);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}



    public function showAllReviews()
    {
        $leaveRequests = $this->leaveService->showAllReviews();
        return LeaveRequestResource::collection($leaveRequests);
    }


    public function reviewRequest(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leaveRequest = LeaveRequest::find($id);
        if (!$leaveRequest) {
            return response()->json([
                'message' => 'Leave request not found',
            ], 404);
        }

        $this->leaveService->reviewRequest($request, $id);


        return response()->json([
            'message' => 'Leave request updated successfully',
        ], 200);
    }


    public function  showRequestForHr()
    {
        $leaveRequests = $this->leaveService->showRequestsForHr();
        return LeaveRequestResource::collection($leaveRequests);
    }
}
