<?php

namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'subtitle',
        'number_of_pages',
        'author',
        'isbn_13',
        'book_type',
    ];
    /**
     * Address Belongs to a Country Model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
