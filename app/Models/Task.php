<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','date',
        'user_id','done'
    ];

    protected static function booted()
    {
        static::addGlobalScope(UserScope::class);

        static::creating(function($task){
            $task->user_id= Auth::id();
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getHumanReadableTimeAttribute(){
        return !is_null($this->date) ? Carbon::getHumanDiffOptions($this->date) : null ;
    }

    protected $appends = ['human_readable_time'];

}
