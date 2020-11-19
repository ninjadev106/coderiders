<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    /**
     * Get box benefits
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function benefits()
    {
        return $this->belongsToMany(Benefit::class);
    }

    /**
     * Get box products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }

    /**
     * Get box period
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function period()
    {
        return $this->belongsTo(ReceiveOption::class, 'resubscribe_period');    
    }
}
