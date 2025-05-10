<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'reason',
        "reviewed_by",
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function manager()
    {
        return $this->belongsTo(User::class, "reviewed_by");
    }
}
