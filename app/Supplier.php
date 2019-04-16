<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name'];
    
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
