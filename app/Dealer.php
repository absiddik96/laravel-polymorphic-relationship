<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $fillable = ['name'];

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
