<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['transfer_id', 'qty', 'lot'];


    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }
}