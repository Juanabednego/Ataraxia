<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola About</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Tambahan agar konten tidak tertutup sidebar jika fixed */
        .main-content {
            margin-left: 250px; /* sesuaikan jika sidebar Anda lebarnya berbeda */
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    {{-- Sidebar Admin --}}
    @include('layouts.AdminNav')

    {{-- Konten Utama --}}
    <main class="main-content">
        <div class="container-fluid">
            <div class="card shadow border-0">
                <div class="card-body">
                    <br>  <br> 
                    <h2 class="mb-4 text-center">Kelola Konten <em>Our Story</em></h2>

                    {{-- Notifikasi sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ url('/admin/kelola-about') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Paragraf 1 --}}
                        <div class="mb-3">
                            <label for="paragraph1" class="form-label">Paragraf 1</label>
                            <textarea class="form-control" name="paragraph1" rows="3">{{ old('paragraph1', $about->paragraph1 ?? '') }}</textarea>
                        </div>

                        {{-- Paragraf 2 --}}
                        <div class="mb-3">
                            <label for="paragraph2" class="form-label">Paragraf 2</label>
                            <textarea class="form-control" name="paragraph2" rows="3">{{ old('paragraph2', $about->paragraph2 ?? '') }}</textarea>
                        </div>

                        {{-- Paragraf 3 --}}
                        <div class="mb-3">
                            <label for="paragraph3" class="form-label">Paragraf 3</label>
                            <textarea class="form-control" name="paragraph3" rows="3">{{ old('paragraph3', $about->paragraph3 ?? '') }}</textarea>
                        </div>

                        {{-- Posisi Gambar --}}
                        <div class="mb-3">
                            <label for="image_position" class="form-label">Posisi Gambar</label>
                            <select class="form-select" name="image_position">
                                <option value="left" {{ (old('image_position', $about->image_position ?? '') == 'left') ? 'selected' : '' }}>Kiri</option>
                                <option value="right" {{ (old('image_position', $about->image_position ?? '') == 'right') ? 'selected' : '' }}>Kanan</option>
                            </select>
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label><br>
                            @if (!empty($about->image_url))
                                <img src="{{ asset($about->image_url) }}" width="200" class="mb-3 rounded shadow d-block">
                            @endif
                            <input type="file" class="form-control" name="image">
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="text-center">
<button type="submit"
        class="btn px-4"
        style="background-color: #8174A0; border-color: #8174A0; color: white;">
    Simpan Perubahan
</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center text-muted">
            &copy; {{ date('Y') }} <strong><span>Ataraxia</span></strong>. All Rights Reserved
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
