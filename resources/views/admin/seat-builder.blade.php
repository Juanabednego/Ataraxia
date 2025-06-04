<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Layout Builder</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <style>
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }

        #builder-area {
            position: relative;
            width: 100%;
            height: 600px;
            border: 2px dashed #ccc;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .seat {
            position: absolute;
            width: 50px;
            height: 50px;
            background-color: #000;
            color: #fff;
            text-align: center;
            line-height: 50px;
            border-radius: 8px;
            cursor: move;
        }

        .seat.selected {
            background-color: #8174A0;
        }

        .seat.booked {
            background-color: grey !important;
            cursor: not-allowed;
        }

        .seat:hover:not(.booked) {
            background-color: #8174A0 !important;
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

        .card, .card1, .card2 {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
        {{-- Sidebar Admin --}}
    @include('layouts.AdminNav')
   <main class="main-content">
  <div class="container py-5">
    <h2 class="mb-4 text-center">Seat Layout Builder</h2>

    @if(!isset($eventId))
      <!-- Pilih Event -->
      <form method="GET" action="{{ route('admin.seat-builder') }}">
        <div class="mb-3">
          <select class="form-select" name="eventId" required>
            <option value="">Pilih Event</option>
            @foreach($events as $event)
              <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
          </select>
        </div>
<button type="submit"
        class="btn"
        style="background-color: #8174A0; border-color: #8174A0; color: white;">
    Pilih Event
</button>
      </form>
    @else
      <!-- Builder Layout Kursi -->
      <form id="saveForm">
        <input type="hidden" id="eventId" value="{{ $eventId }}">
        <div class="mb-3 d-flex gap-2">
          <button type="button" class="btn btn-success" id="addSeat">Tambah Kursi</button>
          <button type="submit" class="btn btn-primary">Simpan Layout</button>
        </div>

        <div id="builder-area" style="position: relative; width: 100%; height: 600px; border: 2px dashed #ccc; margin-bottom: 20px; background-color: #f9f9f9;">
          @foreach ($seats as $seat)
            <div class="seat" data-seat-id="{{ $seat->seat_id }}" data-section="{{ $seat->section }}"
              data-x="{{ $seat->x }}" data-y="{{ $seat->y }}"
              style="left: {{ $seat->x }}px; top: {{ $seat->y }}px; transform: translate({{ $seat->x }}px, {{ $seat->y }}px);">
              {{ $seat->seat_id }}
            </div>
          @endforeach
        </div>
      </form>
    @endif
  </div>
    </main>
   {{-- Footer --}}
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center text-muted">
            &copy; {{ date('Y') }} <strong><span>Ataraxia</span></strong>. All Rights Reserved
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
<script>
  let seatCount = {{ isset($seats) ? $seats->count() : 0 }};

  interact('.seat').draggable({
    listeners: {
      move(event) {
        const target = event.target;
        const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
        const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

        target.style.transform = `translate(${x}px, ${y}px)`;
        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
      }
    }
  });

  document.getElementById('addSeat')?.addEventListener('click', () => {
    seatCount++;
    const seatId = 'S' + seatCount;
    const seat = document.createElement('div');
    seat.className = 'seat';
    seat.dataset.seatId = seatId;
    seat.dataset.section = 'custom';
    seat.dataset.x = 10;
    seat.dataset.y = 10;
    seat.textContent = seatId;
    seat.style.left = '10px';
    seat.style.top = '10px';
    seat.style.transform = 'translate(10px, 10px)';
    document.getElementById('builder-area').appendChild(seat);

    interact(seat).draggable({
      listeners: {
        move(event) {
          const target = event.target;
          const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
          const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

          target.style.transform = `translate(${x}px, ${y}px)`;
          target.setAttribute('data-x', x);
          target.setAttribute('data-y', y);
        }
      }
    });
  });
------------------------------------------------------------------------------------------
  document.getElementById('saveForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const eventId = document.getElementById('eventId').value;
    const seats = [];

    document.querySelectorAll('.seat').forEach(seat => {
      const x = parseFloat(seat.getAttribute('data-x')) || 0;
      const y = parseFloat(seat.getAttribute('data-y')) || 0;

      seats.push({
        seat_id: seat.dataset.seatId,
        section: seat.dataset.section,
        x: x,
        y: y,
        event_id: eventId
      });
    });

    fetch("{{ route('admin.seat-builder.save') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ seats: seats })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Layout kursi berhasil disimpan!');
        window.location.reload();
      }
    })
    .catch(error => {
      console.error('Error saat menyimpan:', error);
    });
  });
</script>
<style>
  .seat {
    position: absolute;
    width: 50px;
    height: 50px;
    background-color: #000;
    color: #fff;
    text-align: center;
    line-height: 50px;
    border-radius: 8px;
    cursor: move;
  }

  .seat.selected {
    background-color: #007bff;
  }

  .seat.booked {
    background-color: grey !important;
    cursor: not-allowed;
  }

  .seat:hover:not(.booked) {
    background-color: blue !important;
  }
</style>

</body>

</html>
