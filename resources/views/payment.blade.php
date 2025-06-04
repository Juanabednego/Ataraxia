<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: rgb(255, 255, 255);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px #8174A0;
        }
        .btn-back {
            background-color: #6c757d;
            border: none;
        }
        .btn-back:hover {
            background-color: #5a6268; /* Abu-abu lebih gelap saat hover */
        }
        .btn-primary {
            background-color: #4CAF50;
            border: none;
        }
        .btn-primary:hover {
            background-color: #388E3C; /* Hijau lebih gelap saat hover */
        }
        .form-label {
            font-weight: bold;
        }
        .modal-content {
            background-color: #F44336;
            color: #ffffff;
        }
        .form-select, .form-control {
            background-color: rgb(248, 250, 248);
            color: #000;
        }
        .payment-details {
            margin-top: 20px;
            padding: 10px;
            background-color: rgb(255, 255, 255);
            color: #000;
            border-radius: 8px;
            display: none;
        }
        .payment-details div {
            display: flex;
            align-items: center;
        }
        .payment-details span {
            margin-right: 10px;
        }
        .payment-details .copy-btn {
            margin-left: 10px;
            cursor: pointer;
        }
        .payment-details .copy-btn i {
            font-size: 18px;
            color: #B5338A;
        }
        .payment-details .copy-btn:hover i {
            color: #F44336;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h2 class="mb-4" style="color: #4CAF50;">Pembayaran</h2>

        <p><strong>Kursi yang Dipilih:</strong> {{ implode(', ', json_decode($booking->seats)) }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($booking->total_price) }}</p>

        <form id="paymentForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

            <div class="mb-3">
                <label class="form-label">Metode Pembayaran:</label>
                <select name="payment_method" class="form-select" required>
                    <option value="bca">Bank BRI</option>
                    <option value="mandiri">Bank Mandiri</option>
                    <option value="ovo">OVO</option>
                    <option value="dana">DANA</option>
                </select>
            </div>

            <!-- Display account details -->
            <div id="paymentDetails" style="display: none;">
                <div>
                    <span id="accountNumber"></span>
                    <button id="copyButton" class="copy-btn">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                <span id="accountName"></span><br>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Bukti Transfer:</label>
                <input type="file" name="proof_of_payment" accept="image/*" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Bayar</button>
        </form>

        <!-- Tombol Kembali -->
        <button onclick="history.back()" class="btn btn-back w-100 mt-3">Kembali</button>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Pembayaran Diproses</h5>
                </div>
                <div class="modal-body text-center">
                    <p>Pembayaran Anda sedang diproses. Silakan tunggu konfirmasi dari Admin.</p>
                </div>
                <div class="modal-footer">
                    <a href="/histori" class="btn btn-success w-100">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Tampilkan detail rekening saat metode pembayaran dipilih
        $("select[name='payment_method']").change(function() {
            var paymentMethod = $(this).val();
            var accountNumber = '';
            var accountName = '';

            if (paymentMethod === 'bca') {
                accountNumber = '3829-0102-7786-533';
                accountName = 'Nama Rekening: David Simanjuntak';
            } else if (paymentMethod === 'mandiri') {
                accountNumber = '987-654-3210';
                accountName = 'Nama Rekening: David Simanjuntak';
            } else if (paymentMethod === 'ovo') {
                accountNumber = '0812-3456-7890';
                accountName = 'Nama Rekening: David Simanjuntak';
            } else if (paymentMethod === 'dana') {
                accountNumber = '0812-9876-5432';
                accountName = 'Nama Rekening: David Simanjuntak';
            }

            $("#accountNumber").text('Nomor Rekening: ' + accountNumber);
            $("#accountName").text(accountName);
            $("#paymentDetails").show();

            // Event handler copy hanya satu kali
            $("#copyButton").off("click").on("click", function(e) {
                e.preventDefault();
                var copyText = accountNumber;
                navigator.clipboard.writeText(copyText)
                    .then(function() {
                        alert("Nomor rekening disalin: " + copyText);
                    })
                    .catch(function(error) {
                        alert("Gagal menyalin: " + error);
                    });
            });
        });

        // Submit form dengan AJAX
        $("#paymentForm").submit(function(event) {
            event.preventDefault();
            let formData = new FormData(this);
            
            $.ajax({
                url: "{{ route('payment.process') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function() {
                    $("#confirmationModal").modal("show");
                },
                error: function() {
                    alert("Terjadi kesalahan, silakan coba lagi.");
                }
            });
        });
    </script>
</body>
</html>
