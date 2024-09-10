<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'taskId'                    =>$this->id,
            'taskName'                  =>$this->name,
            'taskDescription'           =>$this->description,
            'timeDiff'                  =>$this->human_readable_time,
            'username'                  =>(new UserResource($this->whenLoaded('user')))->name,
            'userId'                    =>(new UserResource($this->whenLoaded('user')))->id,
        ];
    }
}
