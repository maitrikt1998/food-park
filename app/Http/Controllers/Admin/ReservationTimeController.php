<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReservationTimeDataTable;
use App\Http\Controllers\Controller;
use App\Models\ReservationTime;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ReservationTimeDataTable $datatable)
    {
        return $datatable->render('admin.reservation.reservation-time.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reservation.reservation-time.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_time' => ['required'],
            'end_time' => ['required'],
            'status' => ['required', 'boolean']
        ]);

        $time = new ReservationTime();
        $time->start_time = $request->start_time;
        $time->end_time = $request->end_time;
        $time->status = $request->status;
        $time->save();

        toastr()->success('Created Successfully!');

        return to_route('admin.reservation-time.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $time =  ReservationTime::findOrFail($id);
        return view('admin.reservation.reservation-time.edit', compact('time'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'start_time' => ['required'],
            'end_time' => ['required'],
            'status' => ['required', 'boolean']
        ]);

        $time = ReservationTime::findOrFail($id);
        $time->start_time = $request->start_time;
        $time->end_time = $request->end_time;
        $time->status = $request->status;
        $time->save();

        toastr()->success('Updated Successfully!');

        return to_route('admin.reservation-time.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $time = ReservationTime::findOrFail($id);
            $time->delete();

            return response(['status'=>'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status'=>'error', 'message' => 'Something Went Wrong!']);
        }
    }
}
