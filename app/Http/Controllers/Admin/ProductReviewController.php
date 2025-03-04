<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductRatingDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductRating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductReviewController extends Controller
{
    //
    function index(ProductRatingDataTable $dataTable) : View|JsonResponse
    {
        return $dataTable->render('admin.product.product-review.index');
    }

    function updateStatus(Request $request): Response
    {
        $productRating = ProductRating::findOrFail($request->id);
        $productRating->status = $request->status;
        $productRating->save();
        return response(['success' => true, 'message'=> 'updated successfully']);
    }

    function destroy(string $id) : Response
    {
        try{
            $review = ProductRating::findOrFail($id);
            $review->delete();
            return response(['status'=>'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status'=>'error', 'message' => 'Something Went Wrong!']);
        }
    }
}
