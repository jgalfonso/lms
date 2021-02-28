<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceItems extends Model
{
    protected $table = 'invoice_items';
    protected $primaryKey = 'system_id';

    public static function getInvoiceItems($invoiceID)
    {
        $invoice_items = self::select('invoice_items.*', 'items.item_name', 'items.item_description')
            ->join('items', 'items.item_id', 'invoice_items.item_id')
            ->where([
                ['invoice_items.invoice_id', $invoiceID],
                ['invoice_items.status', 'Active']
            ])
            ->get();

        return $invoice_items;
    }

    public static function add($request)
    {      
       try {

            $data = [
                'invoice_id'        => $request->invoiceID,
                'item_id'           => $request->itemID,
                'quantity'          => $request->qty,
                'rate'              => $request->rate,
                'amount'            => $request->amount,
                'total'             => $request->total,
                'created_by'        => $request->userID,
                'dt_created'        => date('Y-m-d H:i:s'),
                'status'            => 'Active'
            ];

            self::insert($data);

            return true;

        } catch (\Exception $e) {
            
            return $e->getMessage();
        }
    }
}
