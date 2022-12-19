<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function getCategoryDataByAjax(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $categoryData = Product::with('category')
            ->select('category_id')
            ->where('supplier_id',$supplier_id)
            ->groupBy('category_id')
            ->get();
        return response()->json($categoryData);
    }
    public function getProductDataByAjax(Request $request)
    {
        $category_id = $request->category_id;
        $productData = Product::where('category_id',$category_id)->get();
        return response()->json($productData);
    }
    public function checkProductStockByAjax(Request $request)
    {
        $productId = $request->product_id;
        $stock = Product::where('id',$productId)->first()->quantity;
        return response()->json($stock);
    }
}
