<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Invoices;

class Payments extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    public $timestamps = false;

    public static function getPayments()
    {
        $invoices = self::select('payments.*', 'profiles.control_no', 'profiles.lastname', 'profiles.firstname', 'profiles.middlename', 'invoices.invoice_no')
            ->leftJoin('invoices', 'invoices.invoice_id', 'payments.reference_id')
            ->join('profiles', 'profiles.profile_id', 'payments.customer_id')
            ->where('payments.status', 'Active')
            ->get();

        return $invoices;
    }

    public static function getByID($paymentID)
    {      
        $payments = self::select('payments.*', 'profiles.control_no', 'profiles.lastname', 'profiles.firstname', 'profiles.middlename', 'payment_methods.name AS payment_method')
            ->join('profiles', 'profiles.profile_id', 'payments.customer_id')
            ->join('payment_methods', 'payment_methods.payment_method_id', 'payments.payment_method_id')
            ->where([
                ['payments.payment_id', $paymentID],
                ['payments.status', 'Active']
            ])
            ->first();

        return $payments;
    }

    public static function add($request)
    {      
        DB::beginTransaction();

        try {

             $data = [
                'reference_id'      => ($request->referenceID) ? $request->referenceID : NULL,  
                'customer_id'       => $request->customerID,
                'payment_date'      => date('Y-m-d H:i:s', strtotime($request->paymentDate)),
                'order_memo'        => $request->orderMemo,
                'payment_method_id' => $request->paymentMethod,
                'reference_no'      => $request->referenceNO,
                'amount_due'        => (float) str_replace(',', '', $request->amountDue),
                'amount_paid'       => $request->amountPaid,
                'balance'           => (float) str_replace(',', '', $request->amountDue) - $request->amountPaid,
                'created_by'        => $request->userID,
                'dt_created'        => date('Y-m-d H:i:s'),
                'status'            => 'Active'
            ];

            $id = self::insertGetId($data);
            
            self::where('payment_id', $id)->update(['or_no' => sprintf('%010s', $id)]);

            if($request->referenceID) {
                
                Invoices::where('invoice_id', $request->referenceID)->update([
                    'unpaid'    => (float) str_replace(',', '', $request->amountDue) - $request->amountPaid,
                    'lupd_by'   => $request->userID,
                    'dt_lupd'   => date('Y-m-d H:i:s'),
                    'status'    => ((float) str_replace(',', '', $request->amountDue) - $request->amountPaid == 0) ? 'Paid' : 'Pending'
                ]);
            }

            DB::commit();

            return ['success' => true, 'id' => $id];

        } catch (\Exception $e) {
            
            DB::rollback();
            return $e->getMessage();
        }
    }
}
