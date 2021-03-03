<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Items extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    
    public static function getItems()
    {
        $items = self::where('status', 'Active')->get();

        return $items;
    }

    public static function getByID($itemID)
    {      
        $item = self::where('item_id', $itemID)->first();

        return $item;
    }
}
