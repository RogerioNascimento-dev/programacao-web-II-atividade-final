<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Todo extends Model
{
    use  Notifiable, SoftDeletes;
    protected $table = 'todos';
    protected $primarykey = 'id';
    protected $with = [
        'createdUser:id,name'
    ];

    protected $fillable = ['name', 'description', 'finished', 'estimated_date', 'created_user_id'];

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function getEstimatedDateAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('d/m/Y H:i:s');
        }
        return $value;
    }
}
