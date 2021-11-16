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

    protected $fillable = ['title', 'description', 'finished', 'estimated_date', 'created_user_id'];

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

    public function rulesStore()
    {
        return [
            'title' => 'required|min:6',
            'description' => 'required|min:10',
        ];
    }
    public function rulesUpdate()
    {
        return [
            'title' => 'min:6',
            'description' => 'min:10',
        ];
    }
}
