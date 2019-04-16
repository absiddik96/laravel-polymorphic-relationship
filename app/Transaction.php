<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['ac_no','transaction_type','amount','transactionable_id','transactionable_type'];

    public function transactionable()
    {
        return $this->morphTo();
    }
}
