<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
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

    protected $hidden = [
        'updated_at','created_at',
    ];
    protected $appends = ['human_readable_time'];

    protected static function booted()
    {
        static::addGlobalScope(UserScope::class);

        // static::creating(function($task){
        //     $task->user_id= Auth::id();
        // });
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getHumanReadableTimeAttribute(){
        return !is_null($this->created_at) ? Carbon::parse($this->created_at)->diffForHumans() : null ;
    }


    public function scopeFilter (EloquentBuilder $builder , $filter){
        $options = array_merge([
            'name'                  =>null,
            'description'           =>null,
            'user_id'               =>null,
            'username'              =>null,
            'done'                  =>null,
        ],$filter);
        $builder->when($options['name'], function($builder, $name) {
            $builder->where('name', 'like', "%$name%");
        });
    
        // Filter by description
        $builder->when($options['description'], function($builder, $description) {
            $builder->where('description', 'like', "%$description%");
        });
    
        // Filter by done status (true/false)
        $builder->when(!is_null($options['done']), function($builder, $done) {
            $builder->where('done', $done); // Assuming 'done' is a boolean field in the database
        });
    
        // Filter by user_id
        $builder->when($options['user_id'], function($builder, $userId) {
            $builder->whereHas('user', function($query) use ($userId) {
                $query->where('id', $userId);
            });
        });

        //filter by username
        $builder->when($options['username'], function($builder, $username) {
            $builder->whereHas('user', function($query) use ($username) {
                $query->where('name','like', "%$username%");
            });
        });
    }
}
