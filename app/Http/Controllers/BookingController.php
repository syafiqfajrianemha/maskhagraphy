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
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
        ]);

        Booking::create([
            'service_id' => $request->service_id,
            'user_id' => Auth::id(),
            'phone' => $request->phone,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
        ]);

        return redirect()->route('booking.index')->with('message', 'Booking has been created');
    }

    public function bookingList()
    {
        $bookings = Booking::orderBy('id', 'desc')->get();
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

        if ($request->status === 'approved') {
            $phone = $booking->phone;
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            }

            $tanggal = \Carbon\Carbon::parse($booking->booking_date)->format('d M Y');
            $jam = \Carbon\Carbon::parse($booking->start_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($booking->end_time)->format('H:i');

            $message = "Booking Kamu Telah Disetujui!\n\n" .
                       "*Layanan:* {$booking->service->name}\n" .
                       "*Tanggal:* {$tanggal}\n" .
                       "*Waktu:* {$jam}\n" .
                       "*Lokasi:* {$booking->location}\n" .
                       "*Catatan:* " . ($booking->note ?? '-') . "\n\n" .
                       "Terima kasih telah melakukan booking. Sampai jumpa!";

            $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

            return redirect($waUrl);
        }

        if ($request->status === 'rejected') {
            $phone = $booking->phone;
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            }

            $tanggal = \Carbon\Carbon::parse($booking->booking_date)->format('d M Y');
            $jam = \Carbon\Carbon::parse($booking->start_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($booking->end_time)->format('H:i');

            $message = "Mohon Maaf. Booking Kamu Ditolak!\n\n" .
                       "*Layanan:* {$booking->service->name}\n" .
                       "*Tanggal:* {$tanggal}\n" .
                       "*Waktu:* {$jam}\n" .
                       "*Lokasi:* {$booking->location}\n\n" .
                       "*" . ($request->rejected_note ?? '-') . "*" . "\n\n" .
                       "Silahkan Pilih Tanggal atau Waktu Lain. Terimakasih!";

            $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

            return redirect($waUrl);
        }

        return redirect()->route('booking.list')->with('message', 'Booking Berhasil di ' . $status);
    }
}
