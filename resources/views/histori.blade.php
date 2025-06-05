<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Pemesanan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .ticket-container {
            max-width: 800px;
            margin: 30px auto;
            padding-bottom: 50px;
        }
        .ticket-card { 
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }
        .ticket-header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .ticket-detail {
            margin-bottom: 8px;
            color: #555;
        }
        .ticket-divider {
            border-top: 1px dashed #ccc;
            margin: 15px 0;
        }
        .status-container {
            margin-top: 15px;
        }
        .status-item {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        .status-selesai {
            background-color: #d4edda;
            color: #155724;
        }
        .status-diproses {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-hubungi {
            background-color: #f8d7da;
            color: #721c24;
        }
        .total-harga {
            font-weight: bold;
            color: #333;
        }
        .no-bookings {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        .badge-seat {
            background-color: #6c757d;
            color: white;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .booking-item {
    display: flex;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    margin-bottom: 20px;
    overflow: hidden;
}

.booking-img {
    flex: 0 0 150px;
    height: 150px;
    object-fit: cover;
    border-right: 1px solid #eee;
}

.booking-content {
    padding: 15px;
    flex-grow: 1;
    position: relative;
}

.booking-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.booking-date, .booking-seat, .booking-price {
    font-size: 0.95rem;
    color: #555;
}

.status-badge {
    font-size: 0.85rem;
    font-weight: 500;
    padding: 4px 10px;
    border-radius: 20px;
    display: inline-block;
    margin-top: 8px;
}

.status-diproses {
    background-color: #fff3cd;
    color: #856404;
}

.status-diterima {
    background-color: #cce5ff;
    color: #004085;
}

.status-selesai {
    background-color: #d4edda;
    color: #155724;
}

.booking-actions {
    display: flex;
    flex-direction: column;
    justify-content: center; /* atau flex-end jika mau di bawah */
    align-items: flex-end;
    min-width: 150px;
}

.booking-actions a,
.booking-actions button {
    border: none;
    background-color: #a240c3;
    color: #fff;
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 0.9rem;
    cursor: pointer;
    text-decoration: none;
}

.booking-actions a:hover,
.booking-actions button:hover {
    background-color: #891ab3;
}

    </style>
</head>
<body>
        @include('layouts.Navbar') <!-- Navbar here -->
    <div class="container ticket-container">
        <h2 class="text-center mb-4">Riwayat Pemesanan</h2>
        
        @if($bookings->isEmpty())
            <div class="no-bookings">
                <h4>Anda belum memiliki riwayat pemesanan</h4>
                <p>Silahkan melakukan pemesanan terlebih dahulu</p>
            </div>
        @else
        @foreach($bookings as $booking)
<div class="booking-item">
<img class="booking-img" src="{{ asset($booking->event->image ?? 'storage/events/default.jpg') }}" alt="{{ $booking->event->name ?? 'Gambar event' }}">

    
    <div class="booking-content">
        <div class="booking-title">{{ $booking->event->name ?? 'Event Tidak Ditemukan' }}</div>
        <div class="booking-date">{{ $booking->created_at->format('d F Y \p\u\k\u\l H:i') }}</div>
        
        <div class="booking-seat mt-1">
            Kursi:
            @foreach(json_decode($booking->seats) as $seat)
                <span class="badge bg-secondary">{{ $seat }}</span>
            @endforeach
        </div>
        
        <div class="booking-price mt-1">Total Harga: <strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong></div>
        
        <div class="status-badge 
            @if($booking->status == 'pending') status-diproses 
            @elseif($booking->status == 'cancelled') status-diterima 
            @elseif($booking->status == 'confirmed') status-selesai 
            @endif">
            {{ $statusLabels[$booking->status] }}
        </div>

         <div class="booking-actions">
    <a href="https://wa.me/6283114596027" target="_blank" class="btn btn-success d-flex align-items-center gap-2">
        <i class="bi bi-whatsapp"></i> Hubungi Admin
    </a>
</div>
    </div>
</div>
@endforeach

        @endif
    </div>
    <!-- Riwayat Reservasi Restoran -->
     <div class="container ticket-container">
<h2 class="text-center mb-4">Riwayat Reservasi Restoran</h2>

@if($reservations->isEmpty())
    <div class="no-bookings">
        <h4>Anda belum memiliki riwayat reservasi restoran</h4>
        <p>Silahkan melakukan reservasi terlebih dahulu</p>
    </div>
@else
    @foreach($reservations as $reservation)
        <div class="booking-item">
            <!-- Gunakan gambar default restoran -->
            <img class="booking-img" src="{{ asset('assets/img/logoo.png') }}" alt="Reservasi Restoran">

            <div class="booking-content">
                <div class="booking-title">Reservasi Restoran</div>
                <div class="booking-date">{{ $reservation->created_at->format('d F Y \p\u\k\u\l H:i') }}</div>

                <div class="booking-seat mt-1">
                    Jumlah Orang: <span class="badge bg-secondary">{{ $reservation->people }}</span>
                </div>
                <div class="booking-seat mt-1">
                    Tanggal Reservasi: <strong>{{ \Carbon\Carbon::parse($reservation->date)->format('d F Y') }}</strong>
                </div>
                <div class="booking-seat mt-1">
                    Waktu Reservasi: <strong>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</strong>
                </div>
                <div class="booking-seat mt-1">
                    Nama: <strong>{{ $reservation->name }}</strong>
                </div>
                <div class="booking-seat mt-1">
                    Telepon: <strong>{{ $reservation->phone }}</strong>
                </div>
                <div class="booking-seat mt-1">
                    Catatan: <strong>{{ $reservation->note ?: '-' }}</strong>
                </div>

                <div class="status-badge
                    @if($reservation->status == 'pending') status-diproses
                    @elseif($reservation->status == 'cancelled') status-hubungi
                    @elseif($reservation->status == 'confirmed') status-selesai
                    @endif">
                    {{ $reservationStatusLabels[$reservation->status] ?? ucfirst($reservation->status) }}
                </div>

                <div class="booking-actions">
    <a href="https://wa.me/6283114596027" target="_blank" class="btn btn-success d-flex align-items-center gap-2">
        <i class="bi bi-whatsapp"></i> Hubungi Admin
    </a>
</div>

            </div>
        </div>
    @endforeach
@endif
</div>
</div>
    @include('layouts.footer')

</body>
</html>
