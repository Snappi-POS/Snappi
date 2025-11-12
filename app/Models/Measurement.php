<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = [
        'mainmeasure',
        'submeasure',
        'branch_id',
    ];
    
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    
}