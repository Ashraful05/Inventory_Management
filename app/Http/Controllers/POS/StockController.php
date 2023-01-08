<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
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
    public function SupplierProductWiseStockReport()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('admin.stock.supplier_product_wise_report',compact('suppliers','categories'));
    }
    public function SupplierWiseStockReportPDF(Request $request)
    {
        $allData = Product::orderby('supplier_id','asc')
            ->orderby('category_id','asc')
            ->where('supplier_id',$request->supplier_id)
            ->get();
        return view('admin.pdf.supplier_wise_pdf_report',compact('allData'));
    }
    public function ProductWiseStockReportPDF(Request $request)
    {
        $product = Product::where(['category_id'=>$request->category_id,'id'=>$request->product_id])->first();
        return view('admin.pdf.product_wise_pdf_report',compact('product'));
    }
}
