<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Kelola Reservation</title>
    <link href="{{ asset('assets/img/Ataraxialogo.jpg') }}" rel="icon">
    <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
        .table thead {
            background-color: #fff;
            font-weight: 600;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .btn {
            margin-right: 5px;
        }
        .content-wrapper {
            margin-left: 250px;
            padding: 40px 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .page-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #343a40;
        }
        .badge {
            padding: 0.5em 0.75em;
            font-size: 0.85em;
        }
    </style>
</head>

@include('layouts.AdminNav')

<body>
<main id="main" class="main"> 
<div class="container mt-4">
    <div class="page-title">Kelola Reservasi</div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $res)
                <tr>
                    <td>{{ $res->name }}</td>
                    <td>{{ $res->email }}</td>
                    <td>{{ $res->date }}</td>
                    <td>{{ $res->time }}</td>
                    <td>{{ $res->people }}</td>
                    <td>
                        <span class="badge bg-{{ $res->status == 'confirmed' ? 'success' : ($res->status == 'cancelled' ? 'danger' : 'warning') }}">
                            {{ ucfirst($res->status) }}
                        </span>
                    </td>
                    <td>
                        @if($res->status === 'pending')
                        <button class="btn btn-outline-success btn-sm" onclick="openConfirmModal({{ $res->id }})">Confirm</button>
                        <button class="btn btn-outline-danger btn-sm" onclick="openCancelModal({{ $res->id }})">Cancel</button>
                        @else
                        <span class="text-muted small fst-italic">Status Final</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</main>

<!-- Modal Alasan Penolakan -->
<div class="modal fade" id="cancelReasonModal" tabindex="-1" aria-labelledby="cancelReasonLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="cancelForm" method="POST">
      @csrf
      @method('PATCH')
      <input type="hidden" name="status" value="cancelled">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cancelReasonLabel">Alasan Penolakan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="reason" class="form-label">Masukkan alasan penolakan:</label>
            <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Kirim</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="confirmForm" method="POST">
      @csrf
      @method('PATCH')
      <input type="hidden" name="status" value="confirmed">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Reservasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <p>Pastikan pesanan nya sesuai sebelum Anda mengonfirmasi reservasi ini.</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Konfirmasi</button>
        </div>
      </div>
    </form>
  </div>
</div>

<footer id="footer" class="footer mt-auto py-3 bg-light">
    <div class="container">
        <div class="text-center text-muted">
            &copy; {{ date('Y') }} <strong><span>Ataraxia</span></strong> All Rights Reserved
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openCancelModal(reservationId) {
        const form = document.getElementById('cancelForm');
        form.action = `/admin/kelola-reservation/${reservationId}`;
        document.getElementById('reason').value = '';
        const modal = new bootstrap.Modal(document.getElementById('cancelReasonModal'));
        modal.show();
    }

    function openConfirmModal(reservationId) {
        const form = document.getElementById('confirmForm');
        form.action = `/admin/kelola-reservation/${reservationId}`;
        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        modal.show();
    }
</script>
</body>
</html>
