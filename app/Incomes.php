<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incomes extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id','description', 'amount','income_date', 'tax_year'
    ];

    public function customer()
    {
        return $this->hasOne(Customers::class);
    }
}
