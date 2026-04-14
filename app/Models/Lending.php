<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $fillable = ['name', 'item_id', 'total', 'keterangan', 'date', 'returned_at', 'edited_by'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
