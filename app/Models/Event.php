<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasFactory;
    protected $fillable = [
        'title', 'category_id', 'date', 'location', 'slots', 'status'
    ];
    protected $dates = ['date'];
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function registrations() {
        return $this->hasMany(Registration::class);
    }
    public function volunteerAssignments() {
        return $this->hasMany(VolunteerAssignment::class);
    }
}