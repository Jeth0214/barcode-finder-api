<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'brand'];

    public function transfers() {
        return $this->hasMany(Transfer::class);
    }
    public function items() {
        return $this->hasManyThrough(
            Item::class, 
            Transfer::class,
        );
    }
}
