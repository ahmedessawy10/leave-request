<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "user" => new UserResource($this->user),
            "reason" => $this->reason,
            "status" => $this->status,
            "reviewed_by" => new UserResource($this->manager),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
