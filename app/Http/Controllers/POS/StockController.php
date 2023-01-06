<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function StockReport()
    {
        $allData = Product::orderby('supplier_id','asc')
            ->orderby('category_id','asc')
            ->get();
        return view('admin.stock.stock_report',compact('allData'));
    }
    public function StockReportPDF()
    {
        $allData = Product::orderby('supplier_id','asc')
            ->orderby('category_id','asc')
            ->get();
        return view('admin.pdf.stock_report_pdf',compact('allData'));
    }
}
