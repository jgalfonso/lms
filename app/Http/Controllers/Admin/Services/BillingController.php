<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Create new invoice
     */
    public function newInvoice ()
    {
        return view('admin.services.billing.new-invoice');
    }

    /**
     * Display list of invoice
     */
    public function invoices ()
    {
        return view('admin.services.billing.invoices');

    }

    /**
     * Create new payment
     */
    public function newPayment ()
    {
        return view('admin.services.billing.new-payment');
    }

    /**
     * Display list of payment
     */
    public function payments ()
    {
        return view('admin.services.billing.payments');

    }
}
