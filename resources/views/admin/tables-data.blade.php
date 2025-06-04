<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin Dashboard</title>
    <link href="{{ asset('admin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">
</head>
@include('layouts.AdminNav')
    <!-- Main Content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Kelola Booking Tabel</h1>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Booking Tabel | Hari Ini</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Kursi</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
    @if(count($bookings) > 0)
    @foreach ($bookings as $booking)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $booking->user->name }}</td>
        <td>{{ implode(', ', json_decode($booking->seats)) }}</td>
        <td>{{ $booking->created_at }}</td>
        <td>
            @if($booking->status === 'confirmed')
                <span class="badge bg-success">{{ $booking->status }}</span>
            @elseif($booking->status === 'waiting_payment_confirmation')
                <span class="badge bg-danger">{{ $booking->status }}</span>
            @elseif($booking->status === 'pending')
                <span class="badge bg-secondary">{{ $booking->status }}</span>
            @else
                <span class="badge bg-secondary">{{ $booking->status }}</span>
            @endif
        </td>
        <td>
            @if($booking->payment)
            <button class="btn" style="background-color: #8174A0; color: white;" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $booking->id }}">Detail</button>
            @endif
        </td>
    </tr>
    ...

                                 <!-- Modal for Payment Proof -->
<div class="modal fade" id="paymentModal{{ $booking->id }}" tabindex="-1" aria-labelledby="paymentModalLabel{{ $booking->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #8174A0;">
                <h5 class="modal-title text-white" id="paymentModalLabel{{ $booking->id }}">Konfirmasi pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- Info pesanan -->
                    <div class="col-7" style="font-size: 14px;">
                        <p><strong>Username:</strong><br>{{ $booking->user->name }}</p>
                        <p><strong>Kursi:</strong><br>{{ implode(', ', json_decode($booking->seats)) }}</p>
                        <p><strong>Tanggal:</strong><br>{{ $booking->created_at->format('d/m/Y') }}</p>
                    </div>
                    <!-- Bukti transfer -->
                    <div class="col-5">
                        <img src="{{ asset('uploads/payments/' . $booking->payment?->proof_of_payment) }}"
                             class="img-fluid rounded shadow-sm preview-image"
                             style="max-height: 200px; object-fit: contain; cursor: pointer;" 
                             alt="Proof of Payment"
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal{{ $booking->id }}">
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <form action="{{ route('admin.booking.cancel', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin *menolak* pesanan ini? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">tolak</button>
                </form>

                <form action="{{ route('admin.booking.confirm', $booking->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">terima</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pop-up untuk gambar -->
<div class="modal fade" id="imageModal{{ $booking->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $booking->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #8174A0;">
                <h5 class="modal-title text-white" id="imageModalLabel{{ $booking->id }}">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('uploads/payments/' . $booking->payment?->proof_of_payment) }}" class="img-fluid" alt="Proof of Payment" style="max-height: 500px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>


                                    @endforeach

                                    @else
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data booking</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <form action="{{ route('admin.booking.deleteAll') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning mt-3">Hapus Semua Booking</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Ataraxia</span></strong> All Rights Reserved
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
