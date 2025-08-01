<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $guarded = [];

    public function formWarehouse()
    {
        return $this->belongsTo(WareHouse::class, 'form_warehouse_id');
    }
    public function toWarehouse()
    {
        return $this->belongsTo(WareHouse::class, 'to_warehouse_id');
    }
    public function transferItems()
    {
        return $this->hasMany(TransferItem::class, 'transfer_id');
    }
}
