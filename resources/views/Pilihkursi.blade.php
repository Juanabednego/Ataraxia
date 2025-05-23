<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.Navbar')
    <br>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kursi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        
        .seat-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .seat-group {
            display: grid;
            grid-template-columns: repeat(2, 50px);
            grid-template-rows: repeat(2, 50px);
            gap: 5px;
            justify-content: center;
            background-color: #222;
            padding: 10px;
            border-radius: 10px;
        }

        .seat {
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            font-size: 14px;
            background-color: black;
            color: white;
            border-radius: 10px;
            cursor: pointer;
        }

        .seat.booked {
            background-color: grey !important;
            cursor: not-allowed;
        }

        .seat.selected {
            background-color: blue !important;
        }

        .seat:hover:not(.booked) {
            background-color: blue !important;
        }

        .stage {
            background: linear-gradient(to bottom, #999, #666);
            text-align: center;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 30px;
            width: 80%;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 20px 20px 50px 50px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
            color: white;
            text-transform: uppercase;
        }

        .indoor-row,
        .indoor-rows {
            display: flex;
            justify-content: space-between;
            width: 110%;
            gap: 10px;
        }

        .card {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 10px;
            margin-bottom: 30px;
        }

        .card2 {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 10px;
            margin-bottom: 20px;
        }

       
            .card1 {
                background-color: #f8f9fa;
            border-radius: 15px;
            padding: 10px;
            margin-bottom: 20px;
               
            }
       
    </style>
</head>

<body> 
    <div class="container mx-auto p-4 overflow-x-auto">
        
        
        <div class="row">
            <!-- Outdoor Section -->
            <div class="col-md-6">
                <div class="card">
                    <h5 class="text-center">Outdoor</h5>
                    <div class="seat-container">
                        @php $formattedSeats = $formattedSeats ?? []; @endphp
                        @for($i = 1; $i <= 18; $i++)
                            @php
                                $seatId1 = $i . 'oa';
                                $seatId2 = $i . 'ob';
                                $seatId3 = $i . 'oc';
                                $seatId4 = $i . 'od';
                            @endphp
                            <div class="seat-group">
                                <div class="seat {{ in_array($seatId1, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId1 }}">{{ $seatId1 }}</div>
                                <div class="seat {{ in_array($seatId2, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId2 }}">{{ $seatId2 }}</div>
                                <div class="seat {{ in_array($seatId3, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId3 }}">{{ $seatId3 }}</div>
                                <div class="seat {{ in_array($seatId4, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId4 }}">{{ $seatId4 }}</div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Indoor Section -->
            <div class="col-md-6">
            <div class="stage">STAGE</div>
                <!-- Indoor First Floor -->
                <div class="card1">
                    <h5 class="text-center">Indoor First Floor</h5>
                    <div class="seat-container">
                        @for($i = 1; $i <= 6; $i++) <!-- 6 rows -->
                            <div class="indoor-row">
                                @for($j = 1; $j <= 4; $j++) <!-- 4 groups per row -->
                                    @php 
                                        $seatId1 = ($i - 1) * 4 + $j . 'a'; 
                                        $seatId2 = ($i - 1) * 4 + $j . 'b'; 
                                        $seatId3 = ($i - 1) * 4 + $j . 'c'; 
                                        $seatId4 = ($i - 1) * 4 + $j . 'd'; 
                                    @endphp
                                    <div class="seat-group">
                                        <div class="seat {{ in_array($seatId1, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId1 }}">{{ $seatId1 }}</div>
                                        <div class="seat {{ in_array($seatId2, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId2 }}">{{ $seatId2 }}</div>
                                        <div class="seat {{ in_array($seatId3, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId3 }}">{{ $seatId3 }}</div>
                                        <div class="seat {{ in_array($seatId4, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId4 }}">{{ $seatId4 }}</div>
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
                <br>

                <!-- Second Floor -->
                <div class="card2">
                    <h5 class="text-center">Second Floor</h5>
                    <div class="seat-container">
                        @for($i = 1; $i <= 3; $i++) <!-- 3 rows -->
                            <div class="indoor-rows">
                                @for($j = 1; $j <= 5; $j++) <!-- 5 groups per row -->
                                    @php 
                                        $seatId1 = ($i - 1) * 5 + $j . 'sa'; 
                                        $seatId2 = ($i - 1) * 5 + $j . 'sb'; 
                                        $seatId3 = ($i - 1) * 5 + $j . 'sc'; 
                                        $seatId4 = ($i - 1) * 5 + $j . 'sd'; 
                                    @endphp
                                    <div class="seat-group">
                                        <div class="seat {{ in_array($seatId1, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId1 }}">{{ $seatId1 }}</div>
                                        <div class="seat {{ in_array($seatId2, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId2 }}">{{ $seatId2 }}</div>
                                        <div class="seat {{ in_array($seatId3, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId3 }}">{{ $seatId3 }}</div>
                                        <div class="seat {{ in_array($seatId4, $formattedSeats) ? 'booked' : '' }}" data-seat="{{ $seatId4 }}">{{ $seatId4 }}</div>
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Section -->
       <!-- Booking Section -->
<div class="mt-5">
  <div class="card shadow-lg border-0 rounded-4 p-4 bg-light">
    <h4 class="mb-3 fw-semibold text-dark">
      <i class="bi bi-cash-stack me-2 text-success"></i> Total Harga: 
      <span id="totalPrice" class="text-success">Rp 0</span>
    </h4>

    <h5 class="mb-4 text-dark fw-normal">
      <i class="bi bi-chair me-2 text-primary"></i> Tempat Duduk: 
      <span id="selectedSeats" class="text-primary">-</span>
    </h5>

    <div class="d-flex gap-3">
      <button id="confirmBooking" class="btn btn-success px-4 py-2 rounded-pill shadow-sm d-flex align-items-center" disabled>
        <i class="bi bi-check2-circle me-2"></i> Konfirmasi Pemesanan
      </button>

      <button class="btn btn-outline-danger px-4 py-2 rounded-pill shadow-sm d-flex align-items-center" id="cancelSelection">
        <i class="bi bi-x-circle me-2"></i> Batalkan
      </button>
    </div>
  </div>
</div>

    </div>

    @include('layouts.footer')

<script>
    const eventId = "{{ $eventId }}"; 
    const seatPrice = @json($seatPrice ?? 0);  // Pastikan harga kursi dikirim dengan benar
    console.log("Harga kursi dari database:", seatPrice); // Debug: pastikan harga kursi muncul di console
</script>


    <script>
 $(document).ready(function() {
    let selectedSeats = [];
    const confirmButton = $("#confirmBooking");

    // Fungsi untuk memuat kursi yang sudah dibooking
    function loadSeats() {
        $.ajax({
            url: "{{ route('pilih-kursi') }}", // URL untuk mengambil data kursi yang sudah dibooking
            type: "GET",
            dataType: "json",
            success: function(response) {
                console.log("Kursi yang sudah dipesan:", response.formattedSeats);

                // Reset semua kursi terlebih dahulu (tetap mempertahankan kursi yang sudah dibooking)
                $(".seat").removeClass("selected")
                    .css("background-color", "black")
                    .css("cursor", "pointer")
                    .off("click");

                // Tandai kursi yang sudah dibooking (warna abu-abu)
                response.formattedSeats.forEach(function(seat) {
                    $(".seat[data-seat='" + seat + "']")
                        .addClass("booked")
                        .css("background-color", "grey") // Set background menjadi abu-abu
                        .css("cursor", "not-allowed") // Disable kursi yang sudah dibooking
                        .off("click"); // Pastikan kursi yang dibooking tidak bisa dipilih
                });

                // Tambahkan event click hanya untuk kursi yang belum dibooking
                $(".seat:not(.booked)").click(function() {
                    let seat = $(this).data("seat");

                    if ($(this).hasClass("selected")) {
                        $(this).removeClass("selected");
                        selectedSeats = selectedSeats.filter(s => s !== seat); // Remove seat from selectedSeats
                    } else {
                        if (!selectedSeats.includes(seat)) {
                            $(this).addClass("selected");
                            selectedSeats.push(seat);
                        }
                    }

                    // Update tampilan kursi yang dipilih dan total harga
                    $("#selectedSeats").text(selectedSeats.length > 0 ? selectedSeats.join(', ') : '-');
                    $("#totalPrice").text(`Rp ${selectedSeats.length * seatPrice}`); // Total harga berdasarkan jumlah kursi yang dipilih

                    // Disable tombol konfirmasi jika tidak ada kursi yang dipilih
                    confirmButton.prop("disabled", selectedSeats.length === 0);
                });
            },
            error: function(xhr) {
                console.error("Gagal mengambil kursi terbaru:", xhr.responseText);
            }
        });
    }

    loadSeats(); // Panggil loadSeats saat halaman pertama kali dimuat

    // Proses booking saat tombol konfirmasi diklik
   $("#confirmBooking").click(function() {
    let selectedSeatsString = selectedSeats.join(', ');

    // Kirim data pemesanan ke backend (booking.store)
    $.post("{{ route('booking.store') }}", {
        _token: "{{ csrf_token() }}", // Sertakan CSRF token untuk keamanan
        seats: selectedSeatsString,  // Kursi yang dipilih
        total_price: selectedSeats.length * seatPrice, // Total harga
        event_id: eventId // ID event
    }).done(function(response) {
        // Jika berhasil, lanjutkan ke halaman pembayaran
        if (response.booking_id) {
            loadSeats();  // Reload kursi yang sudah dibooking
            window.location.href = `/payment?booking_id=${response.booking_id}`; // Redirect ke halaman pembayaran
        } else {
            alert("Terjadi kesalahan, silakan coba lagi.");
        }
    }).fail(function(xhr) {
        console.error("Error dari backend:", xhr.responseText);
        alert("Gagal menyimpan pemesanan, coba lagi!");
    });
});

    // Batalkan pemilihan kursi
    $("#cancelSelection").click(function() {
        $(".seat.selected").removeClass("selected");
        selectedSeats = [];
        $("#selectedSeats").text('-');
        $("#totalPrice").text('Rp 0');
        confirmButton.prop("disabled", true);
    });
});


    </script>

</body>

</html>
