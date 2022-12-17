<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function AllInvoice()
    {
        return view('admin.invoice.all_invoice');
    }
}
