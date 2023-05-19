<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Whistlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function whistlist()
    {
        return $this->belongsTo(Whistlist::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
