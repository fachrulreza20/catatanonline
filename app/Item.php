<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title', 'nilai', 'categories_id', 'owner_id' 
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    
}
