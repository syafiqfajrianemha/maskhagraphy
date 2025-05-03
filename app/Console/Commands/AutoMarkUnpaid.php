<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoMarkUnpaid extends Command
{
    protected $signature = 'booking:auto-unpaid';
    protected $description = 'Automatically mark bookings as unpaid if not paid after 1 hour';

    public function handle()
    {
        $expiredBookings = Booking::where('status', 'approved')
            ->where('payment', 'pending')
            ->where('approved_at', '<=', now()->subHour())
            ->get();

        foreach ($expiredBookings as $booking) {
            $booking->payment = 'unpaid';
            $booking->save();
        }

        $this->info('Booking yang melebihi 1 jam di-set unpaid.');

        return 0;
    }
}
