<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reservasi Restoran</title>
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f9f9f9;
      padding: 40px 20px;
    }

    .reservation-container {
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .step-indicator {
      display: flex;
      justify-content: space-between;
      margin-bottom: 30px;
    }

    .step {
      text-align: center;
      flex: 1;
    }

    .step-number {
      background: #ffc107;
      color: #fff;
      font-weight: bold;
      width: 40px;
      height: 40px;
      display: inline-flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
      margin-bottom: 5px;
    }

    .step.inactive .step-number {
      background: #ddd;
    }

    .house-rules {
      background: #f1f1f1;
      padding: 15px;
      border-radius: 10px;
      font-size: 14px;
    }

    .btn-primary,
    .btn-secondary {
      width: 100%;
      margin-top: 20px;
    }

    .btn-primary {
      background: #ffc107;
      border: none;
    }
  </style>
</head>

<body>
  @include('layouts.Navbar')

  <main class="reservation-container">
    <!-- Step indicator -->
    <div class="step-indicator">
      <div class="step" id="step-label-1">
        <div class="step-number">1</div>
        <div>Reservasi</div>
      </div>
      <div class="step inactive" id="step-label-2">
        <div class="step-number">2</div>
        <div>Detail</div>
      </div>
    </div>

    <!-- Step 1 -->
    <section id="step1">
      <form id="step1Form" onsubmit="event.preventDefault(); if(validateStep1()) showStep(2);">
        <div class="mb-3">
          <label for="totalSeats" class="form-label">Jumlah Kursi</label>
          <input type="number" name="totalSeats" class="form-control" id="totalSeats" min="1" max="75" value="1" required
            placeholder="Masukkan jumlah kursi" onfocus="clearZero(this)" />
        </div>
        <div class="mb-3">
          <label for="date" class="form-label">Tanggal</label>
          <input type="date" name="date" class="form-control" id="date" required min="{{ date('Y-m-d') }}" />
        </div>
    <div class="mb-3">
          <label for="time" class="form-label">Jam</label>
        <input type="text" name="time" class="form-control" id="time" placeholder="Pilih jam (01:00 - 23:59)" required />

        </div>

        <div class="house-rules mb-3">
          <strong>Peraturan :</strong>
          <ul>
            <li><strong>Reservasi akan diproses 15 menit setelah waktu pemesanan </strong></li>
            <li>Untuk Request Posisi Kursi, Silahkan Hubungi Admin Melalui Whatsapp</li>
            <li>Untuk rombongan di atas 10 orang, silakan hubungi kami via WhatsApp</li>
          </ul>
        </div>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="agree" required />
          <label class="form-check-label" for="agree">Saya telah membaca dan menyetujui syarat dan ketentuan di atas.</label>
        </div>

        <div class="d-flex justify-content-between">
          <a href="/" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Selanjutnya</button>
        </div>
      </form>
    </section>

    <!-- Step 2 -->
    <section id="step2" style="display: none;">
      <form id="step2Form" onsubmit="event.preventDefault(); showConfirmationModal();">
        <div class="row mb-3">
          <div class="col-md-2">
            <select name="title" class="form-select" id="title" required>
              <option value="" disabled selected>Pilih</option>
              <option value="Mr.">Mr.</option>
              <option value="Mrs.">Mrs.</option>
              <option value="Ms.">Ms.</option>
            </select>
          </div>
          <div class="col-md-5">
            <input type="text" name="firstName" class="form-control" placeholder="Nama Depan" id="firstName" required />
          </div>
          <div class="col-md-5">
            <input type="text" name="lastName" class="form-control" placeholder="Nama Belakang" id="lastName" />
          </div>
        </div>

        <div class="mb-3">
          <input type="email" name="email" class="form-control" placeholder="Alamat Email" id="email" required />
        </div>

        <div class="mb-3 row">
          <div class="col-md-3">
            <input type="text" class="form-control" value="+62" disabled />
          </div>
          <div class="col-md-9">
            <input type="tel" name="phone" class="form-control" placeholder="Nomor Telepon" id="phone" required />
          </div>
        </div>

        <div class="mb-3">
          <textarea name="note" class="form-control" maxlength="85" placeholder="Pesan (Maksimal 85 Karakter)"
            id="note"></textarea>
        </div>

        <div class="form-check mb-4">
          <input class="form-check-input" type="checkbox" id="promotions" />
          <label class="form-check-label" for="promotions">
            Saya ingin sekali menerima rekomendasi dan penawaran tempat makan yang dipersonalisasi!
          </label>
        </div>

        <div class="d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" onclick="showStep(1)">Kembali</button>
          <button type="submit" class="btn btn-primary">Konfirmasi Booking</button>
        </div>
      </form>
    </section>
  </main>
@include('layouts.footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Modal Konfirmasi -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Detail Reservasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <p><strong>Jumlah Kursi:</strong> <span id="confirmTotalSeats"></span></p>
          <p><strong>Tanggal:</strong> <span id="confirmDate"></span></p>
          <p><strong>Waktu:</strong> <span id="confirmTime"></span></p>
          <p><strong>Title:</strong> <span id="confirmTitle"></span></p>
          <p><strong>Nama Depan:</strong> <span id="confirmFirstName"></span></p>
          <p><strong>Nama Belakang:</strong> <span id="confirmLastName"></span></p>
          <p><strong>Email:</strong> <span id="confirmEmail"></span></p>
          <p><strong>Telepon:</strong> <span id="confirmPhone"></span></p>
          <p><strong>Catatan:</strong> <span id="confirmNote"></span></p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
          <button class="btn btn-primary" id="confirmBookingBtn">Lanjutkan Pemesanan</button>
        </div>
      </div>
    </div>
  </div>

  

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr("#time", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i", // format 24 jam
    time_24hr: true,
    minTime: "01:00",
    maxTime: "23:59",
    defaultHour: 10,
    defaultMinute: 0
  });
</script>

  <script>
    function showStep(step) {
      document.getElementById("step1").style.display = step === 1 ? "block" : "none";
      document.getElementById("step2").style.display = step === 2 ? "block" : "none";
      document.getElementById("step-label-1").classList.toggle("inactive", step !== 1);
      document.getElementById("step-label-2").classList.toggle("inactive", step !== 2);
    }

    function clearZero(input) {
      if (input.value === "0") input.value = "";
    }

    function validateStep1() {
      const totalSeats = parseInt(document.getElementById("totalSeats").value);
      const date = document.getElementById("date").value;
      const time = document.getElementById("time").value;
      const agree = document.getElementById("agree").checked;

      if (isNaN(totalSeats) || totalSeats <= 0 || !date || !time || !agree) {
        alert("Harap lengkapi semua kolom dan centang persetujuan.");
        return false;
      }

      const selectedDate = new Date(date);
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      if (selectedDate < today) {
        alert("Tanggal tidak boleh di masa lalu.");
        return false;
      }

      return true;
    }

    function showConfirmationModal() {
      const totalSeats = document.getElementById("totalSeats").value;
      const date = document.getElementById("date").value;
      const time = document.getElementById("time").value;
      const title = document.getElementById("title").value;
      const firstName = document.getElementById("firstName").value;
      const lastName = document.getElementById("lastName").value;
      const email = document.getElementById("email").value;
      const phone = document.getElementById("phone").value;
      const note = document.getElementById("note").value;

      if (!title || !firstName || !email || !phone) {
        alert("Harap lengkapi semua kolom informasi.");
        return;
      }

      document.getElementById("confirmTotalSeats").innerText = totalSeats;
      document.getElementById("confirmDate").innerText = date;
      document.getElementById("confirmTime").innerText = time;
      document.getElementById("confirmTitle").innerText = title;
      document.getElementById("confirmFirstName").innerText = firstName;
      document.getElementById("confirmLastName").innerText = lastName || "-";
      document.getElementById("confirmEmail").innerText = email;
      document.getElementById("confirmPhone").innerText = phone;
      document.getElementById("confirmNote").innerText = note || "-";

      const modal = new bootstrap.Modal(document.getElementById("confirmationModal"));
      modal.show();

      document.getElementById("confirmBookingBtn").onclick = submitReservation;
    }

    async function submitReservation() {
      const totalSeats = document.getElementById("totalSeats").value;
      const title = document.getElementById("title").value;
      const firstName = document.getElementById("firstName").value;
      const lastName = document.getElementById("lastName").value;
      const name = `${title} ${firstName} ${lastName}`.trim();

      const data = {
        name: name,
        email: document.getElementById("email").value,
        phone: document.getElementById("phone").value,
        date: document.getElementById("date").value,
        time: document.getElementById("time").value,
        people: totalSeats,
        note: document.getElementById("note").value,
        _token: document.querySelector('meta[name="csrf-token"]').content,
      };

      try {
        const response = await fetch("{{ route('reservation.store') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": data._token,
          },
          body: JSON.stringify(data),
        });

        if (response.ok) {
          alert("Reservasi berhasil dikonfirmasi!");
          window.location.href = "/histori";
        } else {
          const err = await response.json();
          alert(err.message || "Gagal mengirim reservasi.");
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Terjadi kesalahan saat mengirim reservasi.");
      }
    }
  </script>
</body>

</html>
