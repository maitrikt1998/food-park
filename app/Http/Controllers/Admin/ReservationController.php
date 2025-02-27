<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReservationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReservationController extends Controller
{
    function index(ReservationDataTable $datatable) : View|JsonResponse
    {
        return  $datatable->render('admin.reservation.index');
    }

    function update(Request $request) : Response
    {
        $reservation = Reservation::findOrFail($request->id);
        $reservation->status = $request->status;
        $reservation->save();
        return response()->json(['success' => true, 'message'=> 'updated successfully']);
    }

    function destroy(String $id)
    {
        try{
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();

            return response(['status'=>'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status'=>'error', 'message' => 'Something Went Wrong!']);
        }
    }
}


