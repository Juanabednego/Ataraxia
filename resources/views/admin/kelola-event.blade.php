<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Event</title>

  <style>
    .main {
      margin-left: 300px;
      padding-top: 45px;
    }

    .card {
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .btn:hover {
      transform: scale(1.05);
    }

    .modal-dialog {
      max-width: 800px;
    }

    .modal-header,
    .modal-body {
      padding: 20px;
    }

<<<<<<< HEAD
        .alert {
            margin-top: 20px;
        }

        /* Hilangkan spinner untuk input number */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .table th {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .table td, .table th {
            vertical-align: middle;
            padding: 12px 16px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .card {
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .btn-outline-primary, .btn-outline-danger {
            border-width: 1px;
        }

        .modal-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .modal-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.08);
        }
    </style>
=======
    .alert {
      margin-top: 20px;
    }
  </style>
>>>>>>> 0bab31a2d16c8499c4818cbcb2dc89e9a7882b01
</head>

@include('layouts.AdminNav')

<body>
<main class="main">
    <div class="container-fluid px-4 py-4">
<<<<<<< HEAD
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Event</h2>
            <button class="btn"
        style="background-color: #8174A0; border-color: #8174A0; color: white;"
        data-bs-toggle="modal"
        data-bs-target="#addEventModal">
    <i class="bi bi-plus-circle me-2"></i> Tambah Event
</button>

        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th width="120">Foto</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th width="120">Tanggal</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $index => $event)
                                <tr>
                                    <td class="align-middle">{{ $index + 1 }}</td>
                                    <td class="align-middle">
                                        <img src="{{ asset($event->image) }}" class="rounded" width="80" height="60" style="object-fit: cover;">
                                    </td>
                                    <td class="align-middle fw-bold">{{ $event->name }}</td>
                                    <td class="align-middle">{{ $event->description }}</td>
                                    <td class="align-middle">Rp{{ number_format($event->harga, 0, ',', '.') }}</td>
                                    <td class="align-middle">{{ $event->date ? $event->date->format('d/m/Y') : '-' }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex gap-2">
                                            <style>
    .btn-custom-hover:hover {
        background-color: #8174A0 !important;
        color: white !important;
    }
</style>

<button class="btn btn-sm btn-custom-hover"
        style="color: #8174A0; border: 1px solid #8174A0; background-color: transparent;"
        data-bs-toggle="modal"
        data-bs-target="#editEventModal-{{ $event->id }}">
    <i class="bi bi-pencil-square"></i>
</button>
                                            <form action="{{ route('kelola-event.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($events->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-muted mb-3">Belum ada event</h4>
                        <p class="text-muted">Tambahkan event baru dengan mengklik tombol "Tambah Event" di atas</p>
                    </div>
                @endif
=======
      <!-- Page Header -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Event</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">
          <i class="bi bi-plus-circle me-2"></i> Tambah Event
        </button>
      </div>

      <!-- Flash message -->
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <!-- Event Table -->
      <div class="card shadow-sm border-0">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th width="50">No</th>
                  <th width="120">Foto</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Harga</th>
                  <th width="120">Tanggal</th>
                  <th width="150">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($events as $index => $event)
                <tr>
                  <td class="align-middle">{{ $index + 1 }}</td>
                  <td class="align-middle">
                    <img src="{{ asset($event->image) }}" class="rounded" width="80" height="60"
                      style="object-fit: cover;">
                  </td>
                  <td class="align-middle fw-bold">{{ $event->name }}</td>
                  <td class="align-middle">{{ $event->description }}</td>
                  <td class="align-middle">Rp{{ number_format($event->harga, 0, ',', '.') }}</td>
                  <td class="align-middle">{{ $event->date ? $event->date->format('d/m/Y') : '-' }}</td>
                  <td class="align-middle">
                    <div class="d-flex gap-2">
                      <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#editEventModal-{{ $event->id }}">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                      <!-- Tombol hapus buka modal konfirmasi -->
                      <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteEventModal-{{ $event->id }}">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- Empty State -->
          @if($events->isEmpty())
          <div class="text-center py-5">
            <div class="mb-4">
              <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
>>>>>>> 0bab31a2d16c8499c4818cbcb2dc89e9a7882b01
            </div>
            <h4 class="text-muted mb-3">Belum ada event</h4>
            <p class="text-muted">Tambahkan event baru dengan mengklik tombol "Tambah Event" di atas</p>
          </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-hidden="true">
<<<<<<< HEAD
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('kelola-event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header" style="background-color: #8174A0; color: white;">
    <h5 class="modal-title">
        <i class="bi bi-plus-circle me-2"></i>Tambah Event Baru
    </h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Judul Event</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Event</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" placeholder="Contoh: 50000" min="0" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Gambar Event</label>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
<button type="submit"
        class="btn"
        style="background-color: #8174A0; border-color: #8174A0; color: white;">
    <i class="bi bi-save me-1"></i> Simpan
</button>
                    </div>
                </form>
=======
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <form action="{{ route('kelola-event.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Event Baru</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
>>>>>>> 0bab31a2d16c8499c4818cbcb2dc89e9a7882b01
            </div>
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Judul Event</label>
                  <input type="text" name="name" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Tanggal Event</label>
                  <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Harga</label>
                  <input type="number" name="harga" class="form-control" placeholder="Contoh: 50000" required>
                </div>

                <div class="col-12">
                  <label class="form-label">Deskripsi</label>
                  <textarea name="description" class="form-control" rows="3" placeholder="" required></textarea>
                </div>
                <div class="col-12">
                  <label class="form-label">Gambar Event</label>
                  <input type="file" name="image" class="form-control" accept="image/*" required>
                  <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Edit -->
    @foreach($events as $event)
    <div class="modal fade" id="editEventModal-{{ $event->id }}" tabindex="-1" aria-hidden="true">
<<<<<<< HEAD
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('kelola-event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Event</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Judul Event</label>
                                <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Event</label>
                                <input type="date" name="date" class="form-control" value="{{ $event->date ? $event->date->format('Y-m-d') : '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" value="{{ $event->harga }}" min="0" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3" required>{{ $event->description }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Gambar Event</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <div class="mt-2 d-flex align-items-center gap-3">
                                    <img src="{{ asset($event->image) }}" width="80" class="rounded border">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update</button>
                    </div>
                </form>
=======
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <form action="{{ route('kelola-event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Event</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                aria-label="Close"></button>
>>>>>>> 0bab31a2d16c8499c4818cbcb2dc89e9a7882b01
            </div>
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Judul Event</label>
                  <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Tanggal Event</label>
                  <input type="date" name="date" class="form-control"
                    value="{{ $event->date ? $event->date->format('Y-m-d') : '' }}" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Deskripsi</label>
                  <textarea name="description" class="form-control" rows="3" required>{{ $event->description }}</textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Harga</label>
                  <input type="number" name="harga" class="form-control" value="{{ $event->harga }}" required>
                </div>

                <div class="col-12">
                  <label class="form-label">Gambar Event</label>
                  <input type="file" name="image" class="form-control" accept="image/*">
                  <div class="mt-2 d-flex align-items-center gap-3">
                    <img src="{{ asset($event->image) }}" width="80" class="rounded border">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    @endforeach

<<<<<<< HEAD
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Ataraxia</span></strong> All Rights Reserved
    </div>
</footer>

<script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
=======
    <!-- Modal Hapus Event -->
    @foreach($events as $event)
    <div class="modal fade" id="deleteEventModal-{{ $event->id }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus Event</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus event <strong>{{ $event->name }}</strong>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form action="{{ route('kelola-event.destroy', $event->id) }}" method="POST" class="m-0 d-inline"
              id="deleteForm-{{ $event->id }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </main>

  <style>
    .table th {
      font-weight: 600;
      background-color: #f8f9fa;
    }

    .table td,
    .table th {
      vertical-align: middle;
      padding: 12px 16px;
    }

    .table-hover tbody tr:hover {
      background-color: rgba(0, 0, 0, 0.02);
    }

    .card {
      border-radius: 8px;
      border: 1px solid rgba(0, 0, 0, 0.08);
    }

    .btn-outline-primary,
    .btn-outline-danger {
      border-width: 1px;
    }

    .modal-header {
      border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .modal-footer {
      border-top: 1px solid rgba(0, 0, 0, 0.08);
    }
  </style>

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Ataraxia</span></strong>. All Rights Reserved
    </div>
  </footer>

  <!-- Script -->
  <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
>>>>>>> 0bab31a2d16c8499c4818cbcb2dc89e9a7882b01
</body>

</html>
