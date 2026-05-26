<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function role() {
        return $this->belongsTo(Role::class);
    }
    public function registrations() {
        return $this->hasMany(Registration::class);
    }
    public function volunteerAssignments() {
        return $this->hasMany(VolunteerAssignment::class);
    }
    public function activityLogs() {
        return $this->hasMany(ActivityLog::class);
    }
}