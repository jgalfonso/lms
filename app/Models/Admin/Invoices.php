<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\InvoiceItems;

class Invoices extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'invoice_id';
    public $timestamps = false;

    public static function getInvoices()
    {
        $invoices = self::select('invoices.*', 'profiles.control_no', 'profiles.lastname', 'profiles.firstname', 'profiles.middlename')
            ->join('profiles', 'profiles.profile_id', 'invoices.customer_id')
            ->whereIn('invoices.status', ['New', 'Pending', 'Paid'])
            ->get();

        return $invoices;
    }

    public static function getByID($invoiceID)
    {      
        $invoice = self::select('invoices.*', 'profiles.control_no', 'profiles.lastname', 'profiles.firstname', 'profiles.middlename')
            ->join('profiles', 'profiles.profile_id', 'invoices.customer_id')
            ->where('invoices.invoice_id', $invoiceID)
            ->whereIn('invoices.status', ['New', 'Pending', 'Paid'])
            ->first();

        return $invoice;
    }

    public static function add($request)
    {      
        DB::beginTransaction();

        try {

             $data = [
                'reference_type_id' => ($request->referenceTypeID) ? $request->referenceTypeID : NULL,  
                'reference_id'      => ($request->referenceID) ? $request->referenceID : NULL,  
                'customer_id'       => $request->customerID,
                'invoice_date'      => date('Y-m-d H:i:s', strtotime($request->invoiceDate)),
                'due_date'          => ($request->dueDate) ? date('Y-m-d H:i:s', strtotime($request->dueDate)) : NULL,
                'order_memo'        => $request->orderMemo,
                'billing_to'        => $request->billTo,
                'billing_address'   => $request->billingAddress,
                'subtotal'          => (float) str_replace(',', '', $request->subTotal),
                'total_discount'    => $request->discount,
                'net'               => (float) str_replace(',', '', $request->total),
                'unpaid'            => (float) str_replace(',', '', $request->total),
                'created_by'        => $request->userID,
                'dt_created'        => date('Y-m-d H:i:s'),
                'status'            => 'New'
            ];

            $id = self::insertGetId($data);
            
            self::where('invoice_id', $id)->update(['invoice_no' => sprintf('%010s', $id)]);

            $items = json_decode($request->itemIDS);

            foreach($items as $item){
                
                $request->request->add([
                    'invoiceID' => $id,
                    'itemID'    => $item->itemID,
                    'qty'       => $item->qty,
                    'rate'      => (float) str_replace(',', '', $item->rate),
                    'amount'    => (float) str_replace(',', '', $item->amount),
                    'total'     => (float) str_replace(',', '', $item->amount)
                ]);

                InvoiceItems::add($request);
            }

            DB::commit();

            return ['success' => true, 'id' => $id];

        } catch (\Exception $e) {
            
            DB::rollback();
            return $e->getMessage();
        }
    }
}
