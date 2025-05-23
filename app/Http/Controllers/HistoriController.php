<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class HistoriController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil data booking beserta relasi payment untuk user yang login
        $bookings = Booking::with(['payment'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('histori', [
            'bookings' => $bookings,
            'statusLabels' => [
                'pending' => 'Menunggu Pembayaran',
                'waiting_payment_confirmation' => 'Menunggu Konfirmasi',
                'confirmed' => 'Dikonfirmasi',
                'cancelled' => 'Dibatalkan'
            ],
            'statusClasses' => [
                'pending' => 'status-diproses',
                'waiting_payment_confirmation' => 'status-diproses',
                'confirmed' => 'status-selesai',
                'cancelled' => 'status-hubungi'
            ]
        ]);
    }
}