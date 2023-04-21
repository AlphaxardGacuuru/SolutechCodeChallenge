<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Accesors.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function dueDate(): Attribute
    {
        return Attribute::make(
            get:fn($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get:fn($value) => Carbon::parse($value)->format('d M Y'),
        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get:fn($value) => Carbon::parse($value)->format('d M Y'),
        );
    }

    /*
     * Relationships */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function userTask()
    {
        return $this->hasMany(UserTask::class);
    }

    /*
     * Custom Functions */

    // Get Asignee ID
    public function assigneeId()
    {
        // Check if task is assigned
        if ($this->userTask->count()) {
            return $this->userTask()->orderBy("id", "DESC")->first()->user_id;
        }
    }

    // Get Asignee Name
    public function assigneeName()
    {
        // Check if task is assigned
        if ($this->userTask->count()) {
            $assigneeId = $this->userTask()->orderBy("id", "DESC")->first()->user_id;

			return User::find($assigneeId)->name;
        }
    }
}
