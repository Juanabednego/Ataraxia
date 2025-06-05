<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="#" name="#">
  <title>Ataraxia Cafe</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    .text-truncate-2-lines {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .hover-highlight:hover {
      background-color: #f8f9fa;
      transition: all 0.3s ease-in-out;
      border-left: 4px solid #8174A0;
    }

    .dropdown-menu {
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
      padding: 0.5rem 0;
      max-height: 400px;
      overflow-y: auto;
      backdrop-filter: blur(10px);
    }

    #notificationBadge {
      animation: pulseBadge 1.5s infinite;
      font-size: 0.65rem;
      padding: 0.3em 0.5em;
    }

    @keyframes pulseBadge {
      0% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.2); opacity: 0.8; }
      100% { transform: scale(1); opacity: 1; }
    }

    .btn-event {
      display: inline-block;
      padding: 12px 28px;
      background: linear-gradient(135deg, #8174A0 0%, #a197b7 100%);
      color: white;
      font-weight: 600;
      text-decoration: none;
      border-radius: 50px;
      border: none;
      cursor: pointer;
      text-align: center;
      box-shadow: 0 4px 15px rgba(122, 38, 128, 0.3);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      font-size: 16px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .btn-event:hover {
      background: linear-gradient(135deg, #a197b7 0%, #8174A0 100%);
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(122, 38, 128, 0.4);
      color: white;
    }

    .btn-event:active {
      transform: translateY(1px);
    }

    .btn-event::after {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      width: 5px;
      height: 5px;
      background: rgba(255, 255, 255, 0.5);
      opacity: 0;
      border-radius: 100%;
      transform: scale(1, 1) translate(-50%);
      transform-origin: 50% 50%;
    }

    .btn-event:focus:not(:active)::after {
      animation: ripple 0.6s ease-out;
    }

    @keyframes ripple {
      0% { transform: scale(0, 0); opacity: 0.5; }
      100% { transform: scale(20, 20); opacity: 0; }
    }

    .btn-event:disabled {
      background: #cccccc;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    /* Testimonials Section */
    .testimonials {
      padding: 80px 0;
      background-color: #f8f9fa;
    }

    .review-form-container {
      background: white;
      border-radius: 10px;
    }

    .rating-stars {
      display: flex;
      gap: 8px;
    }

    .star-icon {
      font-size: 28px;
      color: #ddd;
      cursor: pointer;
      transition: all 0.2s;
    }

    .star-icon.active,
    .star-icon:hover {
      color: #ffc107;
    }

    .review-item {
      transition: transform 0.3s;
    }

    .review-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .rating i {
      margin-right: 2px;
      font-size: 18px;
    }

    .btn-primary {
      background-color: #8174A0;
      border-color: #8174A0;
      min-width: 200px;
    }

    .btn-primary:hover {
      background-color: #6b5f87;
      border-color: #6b5f87;
    }

    .text-muted {
      color: #6c757d !important;
    }

  .harga-mulai {
    margin-bottom: 1rem;
  }
  .harga-mulai small {
    display: block;
    color: #6c757d;
    font-size: 0.75rem;
  }
  .harga-mulai span {
    font-size: 1.2rem;
    font-weight: bold;
    color: #8174A0;
  }
  </style>
</head>

<body class="index-page">
     @include('layouts.Navbar')
  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
      <div class="container">
        <div class="hero-background">
          <img src="assets/img/bgstory.jpg" alt="Ataraxia Balige">
          <div class="overlay"></div>
        </div>
        <div class="hero-content">
          <h1 style="font-family: 'Dash Horizon', sans-serif">Ataraxia</h1><br>
          <p style="color: white">ATARAKAN PERASAANMU DI ATARAXIA</p>
          <p class="open-hours" style="color: white">We are open from <br> 10:00 - 23:00</p>
        </div>
      </div>
    </section>
    <!-- /Hero Section -->
     
    <!-- Events Section -->
<section id="events" class="events section py-5">
  <div class="container" data-aos="fade-up">
    <h2 class="text-center fw-bold mb-5">Upcoming Event</h2>

    <div class="row g-4 justify-content-center">
      @foreach($events as $event)
        <div class="col-lg-4 col-md-6">
          <div class="card h-100 shadow-sm border-0 d-flex flex-column position-relative overflow-hidden">
            <!-- Sticker Tanggal -->
            <div class="position-absolute top-0 end-0 m-2 px-3 py-1 bg-dark text-white rounded-pill" style="z-index: 2; font-size: 0.85rem;">
              {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
            </div>

            <img src="{{ asset($event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height: 400px; object-fit: cover;">

            <div class="card-body d-flex flex-column text-center">
              <h5 class="card-title mb-3">{{ $event->name }}</h5>
              <p>{{ $event->description }}</p> <br>
              
              <!-- Harga Mulai dipindahkan ke sini -->
              <div class="harga-mulai">
                <small style="font-size: 0.75rem; display: block;">HARGA MULAI</small>
                <span style="font-size: 1.2rem; font-weight: bold;">
                  Rp. {{ number_format($event->harga, 0, ',', '.') }}
                </span>
              </div>

              @php
                $link = auth()->check() ? route('pilihkursi') : route('login');
              @endphp
              <a href="{{ route('pilih-kursi', ['event_id' => $event->id]) }}" class="btn-event">Beli Tiket</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
<!-- /End Menu Section -->

    <!-- Menu Section -->
    <section id="menu" class="hero section light-background">
      <div class="container">
        <div class="hero-background">
          <img src="assets/img/about-2.jpg" alt="Ataraxia Balige">
          <div class="overlay"></div>
        </div>
        <div class="hero-content">
          <p style="color: white; font-weight: bold">Endless Delicious, Savor Every Bite</p>
          <a href="/menu" class="btn btn-lg mt-3"
             style="background-color:#8174A0; color:rgb(255, 255, 255); border-radius: 30px; padding: 12px 32px; font-weight: bold; box-shadow: 0 4px 12px rgba(0,0,0,0.2); transition: all 0.3s;">
            Explore Menu
          </a>
        </div>
      </div>
    </section>
    <!-- /Menu Section -->

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container section-title" data-aos="fade-up">
        <h1 class="story-title">Our Story</h1>
      </div>

      @if($about)
        <div class="container-story" data-aos="fade-up">
          @if($about->image_position == 'left')
            <div class="image-container">
              <img src="{{ asset($about->image_url) }}" alt="Marsada Band Story">
            </div>
            <div class="content">
              <p class="fst-italic">{{ $about->paragraph1 }}</p><br><br>
              <p class="fst-italic">{{ $about->paragraph2 }}</p><br><br>
              <p class="fst-italic">{{ $about->paragraph3 }}</p>
            </div>
          @else
            <div class="content">
              <p class="fst-italic">{{ $about->paragraph1 }}</p>
              <p class="fst-italic">{{ $about->paragraph2 }}</p>
              <p class="fst-italic">{{ $about->paragraph3 }}</p>
            </div>
            <div class="image-container">
              <img src="{{ asset($about->image_url) }}" alt="Marsada Band Story">
            </div>
          @endif
        </div>
      @else
        <div class="container" data-aos="fade-up">
          <p>Tidak ada data "Our Story" yang tersedia.</p>
        </div>
      @endif
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
      <div class="container">
        <!-- Review Form -->
        <div class="row justify-content-center">
          <div class="col-lg-8 mb-5" data-aos="fade-up">
            <div class="review-form-container p-4 shadow-sm rounded">
              <h2 class="mb-4 text-center">Berikan Review Anda!</h2>
              
              @auth
                @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show">
                    @foreach($errors->all() as $error)
                      <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <form action="{{ route('review.store') }}" method="POST">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                  <div class="mb-4 text-center">
                    <h5 class="mb-3">Rating Anda</h5>
                    <div class="rating-stars mb-3 d-flex justify-content-center">
                      @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star star-icon {{ $i <= old('rating', 0) ? 'active' : '' }}" 
                           data-value="{{ $i }}"></i>
                      @endfor
                      <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', 0) }}" required>
                    </div>
                  </div>

                  <div class="mb-4">
                    <textarea class="form-control" name="comment" rows="4" 
                              placeholder="Bagikan pengalaman anda..." required>{{ old('comment') }}</textarea>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                      Kirim Review
                    </button>
                  </div>
                </form>
              @else
                <div class="alert alert-info text-center">
                  Please <a href="{{ route('login') }}"><strong>Login</strong></a> to submit your review.
                </div>
              @endauth
            </div>
          </div>
        </div>

        <!-- Reviews List -->
<div class="row justify-content-center">
  <div class="col-lg-8" data-aos="fade-up">
    <h2 class="mb-4 text-center">Reviews Pengguna</h2>

    @php
      $visibleCount = 4;
    @endphp

    @forelse($reviews as $index => $review)
      <div class="review-item mb-4 p-4 bg-white rounded shadow-sm review-block {{ $index >= $visibleCount ? 'd-none extra-review' : '' }}">
        <div class="d-flex justify-content-between align-items-start mb-2">
          <div>
            <h5 class="mb-1 fw-bold">{{ $review->user->name ?? 'Anonymous' }}</h5>
            <small class="text-muted d-block">
              {{ $review->created_at->format('M d, Y H:i') }}
            </small>
          </div>

          <div class="rating">
            @for($i = 1; $i <= 5; $i++)
              @if($i <= $review->rating)
                <i class="fas fa-star text-warning"></i>
              @else
                <i class="far fa-star text-warning"></i>
              @endif
            @endfor
          </div>
        </div>

        <p class="mb-0 mt-2">{{ $review->comment }}</p>
      </div>
    @empty
      <div class="alert alert-info text-center">
        No reviews yet. Be the first to review!
      </div>
    @endforelse

    @if(count($reviews) > $visibleCount)
      <div class="text-center mt-3">
        <button id="toggleReviewsBtn" class="btn btn-outline-primary btn-sm">
          Lihat Semua
        </button>
      </div>
    @endif
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleReviewsBtn');
    if (toggleBtn) {
      toggleBtn.addEventListener('click', function () {
        const hiddenReviews = document.querySelectorAll('.extra-review');
        const isHidden = hiddenReviews[0]?.classList.contains('d-none');

        hiddenReviews.forEach(review => {
          review.classList.toggle('d-none');
        });

        toggleBtn.textContent = isHidden ? 'Tutup Semua' : 'Lihat Semua';
      });
    }
  });
</script>

      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <p><span class="description-title">Lokasi</span></p>
      </div><!-- End Section Title -->
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="mb-5">
          <iframe style="width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.4874271235694!2d99.09521957472714!3d2.341378597638207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e0500723a496d%3A0x16648aa653b349cf!2sAtaraxia%20Cafe!5e0!3m2!1sid!2sid!4v1746665637033!5m2!1sid!2sid" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
        </div><!-- End Google Maps --> <br><br>
      </div>
    </section><!-- /Contact Section -->
  </main>

  @include('layouts.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const stars = document.querySelectorAll('.fa-star');
      const ratingInput = document.getElementById('rating');

      // Sorot bintang berdasarkan nilai sebelumnya atau nilai yang ada
      const currentRating = parseInt(ratingInput.value) || 0;
      stars.forEach(function(star, index) {
          if (index < currentRating) {
              star.classList.add('checked');
          } else {
              star.classList.remove('checked');
          }
      });

      stars.forEach(function(star, index) {
          star.addEventListener('click', function() {
              const rating = index + 1;
              ratingInput.value = rating;

              stars.forEach((s, i) => {
                  s.classList.toggle('checked', i < rating);
              });
          });
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
      // Star rating selection
      const stars = document.querySelectorAll('.star-icon');
      const ratingInput = document.getElementById('ratingInput');
      
      stars.forEach(star => {
        star.addEventListener('click', function() {
          const value = parseInt(this.getAttribute('data-value'));
          ratingInput.value = value;
          
          stars.forEach((s, index) => {
            if (index < value) {
              s.classList.add('active');
            } else {
              s.classList.remove('active');
            }
          });
        });
        
        star.addEventListener('mouseover', function() {
          const value = parseInt(this.getAttribute('data-value'));
          
          stars.forEach((s, index) => {
            if (index < value) {
              s.classList.add('hover');
            } else {
              s.classList.remove('hover');
            }
          });
        });
        
        star.addEventListener('mouseout', function() {
          stars.forEach(s => s.classList.remove('hover'));
        });
      });
    });

    function loadUserNotifikasi() {
      $.get("{{ route('load-notifikasi') }}", function (data) {
        let html = "";

        if (data.length > 0) {
          $("#notificationBadge").show().text(data.length);

          data.forEach(n => {
            html += `
              <li>
                <a href="#" 
                   class="dropdown-item py-2 px-3 d-flex align-items-start gap-3 hover-highlight view-notif-detail"
                   data-message="${n.message}" 
                   data-time="${n.created_at}">
                  <i class="bi bi-check-circle-fill text-success fs-5 mt-1"></i>
                  <div class="flex-grow-1">
                    <div class="fw-semibold text-dark text-truncate-2-lines">${n.message}</div>
                    <small class="text-muted">${n.created_at}</small> <br>
                    <small class="text-muted">"Klik to detail"</small>
                  </div>
                </a>
              </li>
            `;
          });

        } else {
          html = `<li>
            <a class="dropdown-item py-2 px-3 text-muted">Tidak ada notifikasi</a>
          </li>`;
          $("#notificationBadge").hide();
        }

        $("#notificationDropdownList").html(html);
      });
    }

    loadUserNotifikasi();
    setInterval(loadUserNotifikasi, 10000); // 10 detik

    $(document).on("click", ".view-notif-detail", function (e) {
      e.preventDefault();
      const message = $(this).data("message");
      const time = $(this).data("time");

      $("#notificationDetailMessage").text(message);
      $("#notificationDetailTime").text("Diterima: " + time);
      $("#notificationDetailModal").modal("show");
    });
    
  </script>

  <!-- Modal Informasi Akun -->
  @auth
  <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="accountModalLabel">Informasi Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
          <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>
        <div class="modal-footer">
          <a href="{{ route('akun') }}" class="btn btn-primary">Lihat Selengkapnya</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  @endauth

  <!-- MODAL DETAIL NOTIFIKASI -->
  <div class="modal fade" id="notificationDetailModal" tabindex="-1" aria-labelledby="notificationDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content shadow rounded-3">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="notificationDetailLabel">Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <p class="mb-1 fw-semibold" id="notificationDetailMessage">...</p>
          <p style="font-size: 12px;">Mohon tunjukkan detail ini kepada tim penulis guna keperluan verifikasi akses Anda.</p>
          <br>
          <small class="text-muted" id="notificationDetailTime">...</small>
        </div>
      </div>
    </div>
  </div>
</body>
</html>