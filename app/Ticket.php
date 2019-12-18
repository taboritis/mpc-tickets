<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @package App
 */
class Ticket extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notes()
    {
        return $this->morphMany(Note::class, 'referable');
    }

}
