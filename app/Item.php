<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['title', 'status'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function scopePending($query)
    {
    	return $query->where('status', '=', 'pending');
    }

    public function scopeComplete($query)
    {
    	return $query->where('status', '=', 'complete');
    }
}
