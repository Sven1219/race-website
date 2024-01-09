<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dog;

class RaceForm extends Model
{
    protected $primaryKey = 'dog_id';
    public function dogs()
    {
        return $this->hasMany(Dog::class, 'dog_id', 'dog_id');
    }
}
