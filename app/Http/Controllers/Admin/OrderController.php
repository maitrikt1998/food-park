<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.order.index');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return View('admin.order.show',compact('order'));
    }
}
