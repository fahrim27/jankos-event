<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = ['id'];

    public function team()
    {
        return $this->belongsTo(User::class);
    }
}
