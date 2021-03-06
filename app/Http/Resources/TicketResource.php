<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d h:m'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d h:m'),
            'closed_at' => (!$this->closed_at == null) ? Carbon::parse($this->closed_at)->format('Y-m-d h:m') : null,
            'assignedTo' => $this->assignedTo->fullname(),
            'author' => $this->author->fullname(),
            'notesNo' => $this->notes->count(),
            'path' => $this->path(),
        ];
    }
}
