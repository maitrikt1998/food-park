<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeclinedOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\InProcessOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.order.index');
    }

    public function pendingorderIndex(PendingOrderDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.order.pending-order-index');
    }

    public function inProcessorderIndex(InProcessOrderDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.order.inprocess-order-index');
    }

    public function deliveredorderIndex(DeliveredOrderDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.order.delivered-order-index');
    }

    public function declineddorderIndex(DeclinedOrderDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.order.declined-order-index');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return View('admin.order.show',compact('order'));
    }

    function getOrderStatus(string $id): Response
    {
        $order = Order::select(['order_status','payment_status'])->findOrFail($id);
        return response($order);

    }

    function orderStatusUpdate(Request $request,String $id): RedirectResponse|Response
    {
        $request->validate([
            'payment_status' => ['required', 'in:pending,completed'],
            'order_status' => ['required', 'in:pending,in_process,delivered,declined'],
        ]);

        $order = Order::find($id);
        $order->payment_status = $request->payment_status;
        $order->order_status = $request->order_status;
        $order->save();

        if($request->ajax()){
            return response(['message' => 'Order Status Updated!']);
        }else{
            toastr()->success('Status Updated Successfully!');
            return redirect()->back();
        }
    }

    function destroy(string $id) : Response
    {
        try{
            $order = Order::findOrFail($id);
            $order->delete();
            return response(['status'=>'success', 'message' => 'Order Deleted Successfully!']);
        }catch(\Exception $e){
            logger($e);
            return response(['status'=>'error', 'message' => 'Something went wrong!']);
        }
        
    }
}
