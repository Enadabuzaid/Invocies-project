<?php

namespace App\Http\Controllers;
use App\Models\invoice;

use Illuminate\Http\Request;

class InvoiceAchiveController extends Controller
{
    public function index()
    {
        $invoices = invoice::onlyTrashed()->get();
        return view('Invoices.Archive_Invoices',compact('invoices'));
    }

    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $flight = Invoice::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    public function destroy(Request $request)
    {
        $invoices = invoice::withTrashed()->where('id',$request->invoice_id)->first();
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/Archive');

    }
}
