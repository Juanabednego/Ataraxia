<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ataraxia Cafe</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <!-- Favicons -->
  <link href="{{ asset('assets/img/Ataraxialogo.jpg') }}" rel="icon" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" />

  <style>
    /* Truncate teks jadi max 2 baris */
    .text-truncate-2-lines {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* Hover lembut untuk UX bagus */
    .hover-highlight:hover {
      background-color: #f8f9fa;
      transition: all 0.3s ease-in-out;
      border-left: 4px solid #0d6efd;
    }

    /* Bayangan dan radius lembut */
    .dropdown-menu {
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
      padding: 0.5rem 0;
      max-height: 400px;
      overflow-y: auto;
      backdrop-filter: blur(10px);
    }

    /* Badge animasi pulse */
    #notificationBadge {
      animation: pulseBadge 1.5s infinite;
      font-size: 0.65rem;
      padding: 0.3em 0.5em;
    }

    @keyframes pulseBadge {
      0% {
        transform: scale(1);
        opacity: 1;
      }

      50% {
        transform: scale(1.2);
        opacity: 0.8;
      }

      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    .btn-login i {
      font-size: 28px;
      /* Ukuran ikon, bisa disesuaikan */
    }

    .nav-bold li a {
      font-weight: bold;
    }

    .navmenu ul li a {
      text-decoration: none !important;
    }

    .navmenu ul li a:hover {
      color: #8174A0;
      /* atau warna tema kamu */
      text-decoration: none;
    }

    .logo {
      text-decoration: none !important;
    }

    .logo-img {
      height: 40px;
      /* Atur tinggi logo supaya tidak terlalu besar */
      width: auto;
    }

    .sitename {
      font-weight: 700;
      font-size: 1.5rem;
    }

    .navbar-nav .nav-link {
      padding: 0.5rem 1rem;
      font-weight: 600;
    }

    @media (max-width: 767.98px) {
      .navbar-nav .nav-link {
        padding: 0.4rem 0.75rem;
        font-size: 0.9rem;
      }
    }
  </style>
</head>

<body class="index-page">
  <header id="header" class="header sticky-top py-3 bg-white shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">

      <!-- Logo -->
      <a href="{{ route('index') }}" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('assets/img/logoo.png') }}" alt="Ataraxia Logo" class="logo-img" />
        <h1 class="sitename ms-2 mb-0">Ataraxia</h1>
      </a>

      <!-- Navbar menu + toggle -->
      <nav class="navbar navbar-expand-xl ms-3">
        <div class="container-fluid p-0">
          <!-- Toggle Button -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Menu Items -->
          <div class="collapse navbar-collapse" id="navbarMenu">
           <ul class="navbar-nav ms-auto mb-2 mb-xl-0">
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->is('events*') ? 'active' : '' }}" href="#"  id="navEventsLink">Events</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->is('menu') ? 'active' : '' }}" href="#" id="navMenuLink">Menu</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->is('reservation') ? 'active' : '' }}" href="/reservation">Reservation</a>
  </li>
</ul>

          </div>
        </div>  
      </nav>

      <!-- Icon Notifikasi dan User di sebelah kanan -->
      <div class="d-flex align-items-center ms-3 gap-3">
        @auth
        <!-- Notifikasi -->
        <div class="nav-item dropdown position-relative">
          <a class="nav-link dropdown-toggle d-flex align-items-center position-relative" href="#" id="notificationDropdown"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bell-fill fs-4 text-dark"></i>
            <span id="notificationBadge"
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm"
              style="display: none;">
              1
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown"
            style="min-width: 320px; max-width: 360px;">
            <li class="dropdown-header fw-bold text-dark px-3 pt-2">🔔 Notifikasi Terbaru</li>
            <li>
              <a class="dropdown-item py-2 px-3 d-flex align-items-start gap-3 hover-highlight" href="#">
                <i class="bi bi-info-circle-fill text-muted fs-5 mt-1"></i>
                <div class="flex-grow-1">
                  <div class="fw-semibold text-muted text-truncate-2-lines">Belum ada notifikasi</div>
                  <small class="text-muted">Kamu akan melihatnya di sini</small>
                </div>
              </a>
            </li>
          </ul>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown">
          <button class="btn p-0 border-0 bg-transparent d-flex align-items-center" type="button" id="userDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user fs-5 text-dark"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0 mt-2" aria-labelledby="userDropdown">
            <li><button class="dropdown-item py-2" data-bs-toggle="modal" data-bs-target="#accountModal">Akun Saya</button>
            </li>
            <li><a class="dropdown-item py-2" href="/histori">Histori</a></li>
            <li>
              <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item py-2 text-danger">Logout</button>
              </form>
            </li>
          </ul>
        </div>
        @endauth

        @guest
        <a href="/login" class="btn p-0 border-0 bg-transparent d-flex align-items-center" style="line-height: 1;">
          <i class="fas fa-user fs-5 text-dark"></i>
        </a>
        @endguest
      </div>
    </div>  
  </header>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const navEventsLink = document.getElementById('navEventsLink');

    navEventsLink.addEventListener('click', function (e) {
      e.preventDefault();

      // Cek halaman saat ini
      const currentPath = window.location.pathname;

      if (currentPath === '/menu', '/reservation', '/histori') {
        // Jika di halaman menu, arahkan ke homepage dan scroll ke #events setelah load
        window.location.href = '/#events';

        // Jika ingin scroll halus setelah load (harus ada di halaman home script yg handle ini)
      } else {
        // Jika bukan di halaman menu, langsung scroll ke #events (misal di homepage)
        const eventSection = document.getElementById('events');
        if (eventSection) {
          eventSection.scrollIntoView({ behavior: 'smooth' });
        }
      }
    });
  });
</script>
 <script>
  document.addEventListener('DOMContentLoaded', function () {
    const navEventsLink = document.getElementById('navMenuLink');

    navEventsLink.addEventListener('click', function (e) {
      e.preventDefault();

      // Cek halaman saat ini
      const currentPath = window.location.pathname;

      if (currentPath === '/events', '/reservation', '/histori') {
        // Jika di halaman menu, arahkan ke homepage dan scroll ke #events setelah load
        window.location.href = '/menu';

        // Jika ingin scroll halus setelah load (harus ada di halaman home script yg handle ini)
      } else {
        // Jika bukan di halaman menu, langsung scroll ke #events (misal di homepage)
        const eventSection = document.getElementById('events');
        if (eventSection) {
          eventSection.scrollIntoView({ behavior: 'smooth' });
        }
      }
    });
  });
</script>
<script>
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
