<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('service')->where('user_id', Auth::id())->latest()->get();
        $services = Service::all();
        return view('booking.index', compact('bookings', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'phone' => 'required|numeric',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
        ]);

        Booking::create([
            'service_id' => $request->service_id,
            'user_id' => Auth::id(),
            'phone' => $request->phone,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
        ]);

        return redirect()->route('booking.index')->with('message', 'Booking has been created');
    }

    public function bookingList()
    {
        $bookings = Booking::all();
        return view('booking.booking_list', compact('bookings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['required'],
        ]);

        if ($request->status === 'rejected') {
            $request->validate([
                'rejected_note' => ['required'],
            ]);
        }

        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => $request->status,
            'note' => $request->rejected_note
        ]);

        $status = $request->status === 'approved' ? 'Disetujui' : 'Ditolak';

        return redirect()->route('booking.list')->with('message', 'Booking Berhasil di ' . $status);
    }
}
