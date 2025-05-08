<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'linkedin',
    ];
    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

}
