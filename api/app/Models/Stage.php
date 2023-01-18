<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];



    /**
     * Get all classes for stage 
     * 
     * @return Model::hasMany
     */
    public function classes()
    {

        return $this->hasMany(Classes::class);
    }

}
