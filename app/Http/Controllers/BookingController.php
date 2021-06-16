<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pickup' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'passengers' => 'required|numeric',
            'book_date' => 'required|date|date_format:Y-m-d|after:'.date('Y-m-d'),
            'book_time' => 'required',
        ]);
        $did=[];
        // if($request->driver_id=='')`
        //     $bookid['driver_id'=>]
        $book=new Booking(
            array_merge(
                $validatedData,
                [
                    'user_id'=>auth('sanctum')->user()->id,
                    'type' => 'scheduled'
                ]
            ));
        $book->save();
        return \response(['msg'=>'booked successfully','status'=>'success']);
    }
    public function reservations()
    {
        $user = auth('sanctum')->user();
        if($user->acctype=='admin'||$user->acctype=='driver')
            return \response(['booking'=>Booking::all()]);
        return \response(['booking'=>$user->booking]);
    }
    
    public function scheduled()
    {
        $user = auth('sanctum')->user();
        return \response([
            'scheduled'=>Booking::where('type','scheduled')
            ->with(['drivers'])
                ->get()
        ]);
    }
    
    public function pickup(Request $request)
    {
        $validatedData = $request->validate([
            'pickup' => 'required|string|max:255',
            'passengers' => 'required|numeric',
            'destination' => 'required|string|max:255',
        ]);
        $book=new Booking(
            array_merge(
                $validatedData,
                [
                    'user_id'=>auth('sanctum')->user()->id,
                    'book_date' => date('Y-m-d'),
                    'book_time' => date('H:i:s'),
                    'status' => 'for pickup',
                    'type' => 'pickup'
                ]
            ));
        // return \response(['book'=>$validatedData]);
        $book->save();
        return \response(['msg'=>'booked successfully','status'=>'success']);
    }
    public function cancel(Booking $id)
    {
        $id->status='canceled';
        $id->update();
        return \response(['id'=>$id,'status'=>'success']);
    }
    public function setdriver(Request $request,Booking $id)
    {
        $id->drivers()->sync($request->input('setdriver'));
        return \response(['status'=>'success']);
        // return response(['res'=>$request->input('setdriver')]);
    }
}
