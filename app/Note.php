<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * @package App
 */
class Note extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Polymorphic relation to Ticket or User
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function referable()
    {
        return $this->morphTo();
    }


}
