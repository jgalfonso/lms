<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Admissions;
use App\Models\Admin\Invoices;
use App\Models\Admin\InvoiceItems;
use App\Models\Admin\Items;
use App\Models\Admin\Profiles;

class BillingController extends Controller
{
    public function index ()
    {
        $invoices = Invoices::getInvoices();
        return view('admin.services.billing.index', compact('invoices'));
    }

    public function new($referenceID = null, $profileID = null)
    {
        $today = date('d/m/Y');
        $items = Items::getItems();

        if(IS_NULL($referenceID) && IS_NULL($profileID)) {
            
            $customers = Profiles::getByUserTypeID(1);
            
            return view('admin.services.billing.new', compact('referenceID', 'profileID', 'today', 'customers', 'items'));
        } else {

            $customer = Profiles::getByID($profileID);
            $item = Items::getByID(1);
            $admissions = Admissions::getPending($referenceID);

            return view('admin.services.billing.new', compact('referenceID', 'profileID', 'today', 'customer', 'item', 'items', 'admissions'));
        }
    }

    public function store(Request $request) 
    {   
        $request->request->add(['referenceTypeID' => 1, 'userID' => Auth::id()]);
        $data = Invoices::add($request);

        echo json_encode($data);
    }

    public function view($id)
    {
        $invoice = Invoices::getByID($id);
        $invoice_items = InvoiceItems::getInvoiceItems($id);
        $admissions = Admissions::getPending($invoice->reference_id);

        return view('admin.services.billing.view', compact('invoice', 'invoice_items', 'admissions'));
    }

    public function forms($id)
    {
        $invoice = Invoices::getByID($id);
        $invoice_items = InvoiceItems::getInvoiceItems($id);
        $admissions = Admissions::getPending($invoice->reference_id);

        return view('admin.forms.invoice', compact('invoice', 'invoice_items', 'admissions'));
    }
}
