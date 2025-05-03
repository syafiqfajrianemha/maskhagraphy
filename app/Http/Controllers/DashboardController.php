<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     // Produk yang belum terjual
    //     $availableProducts = Product::where('status', 'available')->get();

    //     // Produk yang sudah terjual
    //     $soldProducts = Product::where('status', 'unavailable')->get();

    //     // Total pendapatan potensial (jika semua produk terjual)
    //     $totalPotentialRevenue = Product::sum('price');

    //     // Total pendapatan dari produk yang sudah terjual
    //     $totalEarnedRevenue = Product::where('status', 'unavailable')->sum('price');

    //     return view('dashboard', [
    //         'availableProducts' => $availableProducts,
    //         'soldProducts' => $soldProducts,
    //         'totalPotentialRevenue' => $totalPotentialRevenue,
    //         'totalEarnedRevenue' => $totalEarnedRevenue,
    //     ]);
    // }


    // public function index()
    // {
    //     $availableProducts = Product::where('status', 'available')->get();
    //     $soldProducts = Product::where('status', 'unavailable')->get();

    //     $totalPotentialRevenue = Product::sum('price');
    //     $totalEarnedRevenue = Product::where('status', 'unavailable')->sum('price');

    //     // Rekap penjualan
    //     $totalProducts = Product::count();
    //     $totalSold = $soldProducts->count();
    //     $totalAvailable = $availableProducts->count();
    //     $soldPercentage = $totalProducts > 0 ? round(($totalSold / $totalProducts) * 100, 2) : 0;

    //     // Grafik: pendapatan per bulan (dari produk terjual)
    //     $monthlyRevenue = Product::where('status', 'unavailable')
    //         ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(price) as total')
    //         ->groupBy('month')
    //         ->orderBy('month')
    //         ->get();

    //     $chartLabels = $monthlyRevenue->pluck('month');
    //     $chartData = $monthlyRevenue->pluck('total');

    //     return view('dashboard', compact(
    //         'availableProducts',
    //         'soldProducts',
    //         'totalPotentialRevenue',
    //         'totalEarnedRevenue',
    //         'totalProducts',
    //         'totalSold',
    //         'totalAvailable',
    //         'soldPercentage',
    //         'chartLabels',
    //         'chartData'
    //     ));
    // }

    public function index(Request $request)
    {
        $filter = $request->get('filter', 'monthly');

        $availableProducts = Product::where('status', 'available')->get();
        $soldProducts = Product::where('status', 'unavailable')->get();

        $totalPotentialRevenue = Product::sum('price');
        $totalEarnedRevenue = Product::where('status', 'unavailable')->sum('price');

        $totalProducts = Product::count();
        $totalSold = $soldProducts->count();
        $totalAvailable = $availableProducts->count();
        $soldPercentage = $totalProducts > 0 ? round(($totalSold / $totalProducts) * 100, 2) : 0;

        // Grafik Pendapatan
        $query = Product::where('status', 'unavailable');

        if ($filter == 'daily') {
            $revenueData = $query
                ->selectRaw('DATE(created_at) as label, SUM(price) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } elseif ($filter == 'weekly') {
            $revenueData = $query
                ->selectRaw('YEARWEEK(created_at, 1) as label, SUM(price) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get()
                ->map(function ($item) {
                    $yearWeek = $item->label;
                    $year = substr($yearWeek, 0, 4);
                    $week = substr($yearWeek, 4);
                    $startOfWeek = \Carbon\Carbon::now()->setISODate($year, $week)->startOfWeek()->format('Y-m-d');
                    $endOfWeek = \Carbon\Carbon::now()->setISODate($year, $week)->endOfWeek()->format('Y-m-d');
                    $item->label = "$startOfWeek - $endOfWeek";
                    return $item;
                });
        } elseif ($filter == 'range') {
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');

            $revenueData = $query
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('DATE(created_at) as label, SUM(price) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } else {
            // monthly (default)
            $revenueData = $query
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, SUM(price) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        }

        $chartLabels = $revenueData->pluck('label');
        $chartData = $revenueData->pluck('total');

        $bookingQuery = Booking::where('status', 'approved')
            ->whereIn('payment', ['pending', 'paid']);

        if ($filter == 'daily') {
            $bookingStats = $bookingQuery
                ->selectRaw('DATE(approved_at) as label, COUNT(*) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } elseif ($filter == 'weekly') {
            $bookingStats = $bookingQuery
                ->selectRaw('YEARWEEK(approved_at, 1) as label, COUNT(*) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get()
                ->map(function ($item) {
                    $yearWeek = $item->label;
                    $year = substr($yearWeek, 0, 4);
                    $week = substr($yearWeek, 4);
                    $startOfWeek = \Carbon\Carbon::now()->setISODate($year, $week)->startOfWeek()->format('Y-m-d');
                    $endOfWeek = \Carbon\Carbon::now()->setISODate($year, $week)->endOfWeek()->format('Y-m-d');
                    $item->label = "$startOfWeek - $endOfWeek";
                    return $item;
                });
        } elseif ($filter == 'range') {
            $bookingStats = $bookingQuery
                ->whereBetween('approved_at', [$startDate, $endDate])
                ->selectRaw('DATE(approved_at) as label, COUNT(*) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } else {
            // monthly (default)
            $bookingStats = $bookingQuery
                ->selectRaw('DATE_FORMAT(approved_at, "%Y-%m") as label, COUNT(*) as total')
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        }

        $bookingChartLabels = $bookingStats->pluck('label');
        $bookingChartData = $bookingStats->pluck('total');

        $totalBookingRevenue = Booking::where('status', 'approved')
            ->where('payment', 'paid')
            ->with('service')
            ->get()
            ->sum(function ($booking) {
                return $booking->service->price;
            });

        $totalEarnedRevenue = $totalEarnedRevenue + $totalBookingRevenue;

        return view('dashboard', compact(
            'availableProducts',
            'soldProducts',
            'totalPotentialRevenue',
            'totalEarnedRevenue',
            'totalProducts',
            'totalSold',
            'totalAvailable',
            'soldPercentage',
            'chartLabels',
            'chartData',
            'bookingChartLabels',
            'bookingChartData',
            'filter'
        ));
    }
}
