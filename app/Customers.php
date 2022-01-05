<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','utr', 'dob', 'phone', 'profile_pic'
    ];

    public function customerIncomes(){
        return $this->hasMany(Incomes::class);
    }

}
