<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    /**
     * Address Belongs to a Country Model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
