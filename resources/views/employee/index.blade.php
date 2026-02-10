{{-- resources/views/employee/attendance/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">

    <h1 class="text-xl font-semibold mb-4">Absensi Hari Ini</h1>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-3 text-green-600">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="mb-3 text-red-600">{{ $errors->first() }}</div>
    @endif

    {{-- Status --}}
    <div class="mb-4">
        @if(!$attendance)
            <p>Status: <strong>Belum Check-in</strong></p>
        @elseif($attendance && !$attendance->check_out_at)
            <p>Status: <strong>Sudah Check-in</strong></p>
            <p>Jam Masuk: {{ $attendance->check_in_at }}</p>
        @else
            <p>Status: <strong>Sudah Check-out</strong></p>
            <p>Jam Masuk: {{ $attendance->check_in_at }}</p>
            <p>Jam Pulang: {{ $attendance->check_out_at }}</p>
        @endif
    </div>
@if(!$attendance || !$attendance->check_in_at)
<form method="POST"
      action="{{ route('attendance.check-in') }}"
      enctype="multipart/form-data">

    @csrf

    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="lng" id="lng">

    <div class="mb-3">
        <label class="block text-sm">Foto Selfie</label>
        <input type="file" name="photo" accept="image/*" capture="user" required>
    </div>

    <div id="location-info" class="text-sm mb-3 text-gray-600">
        Mengambil lokasi...
    </div>

    <button id="checkin-btn"
        class="w-full bg-blue-600 text-white py-2 rounded"
        disabled>
        Check In
    </button>
</form>
@endif


@if($attendance && $attendance->check_in_at && !$attendance->check_out_at)
<form method="POST"
      action="{{ route('attendance.check-out') }}"
      enctype="multipart/form-data"
      class="mt-6">

    @csrf

    <input type="hidden" name="lat" id="lat-out">
    <input type="hidden" name="lng" id="lng-out">

    <div class="mb-3">
        <label class="block text-sm">Foto Selfie</label>
        <input type="file"
               name="photo"
               accept="image/*"
               capture="user"
               required>
    </div>

    <button type="submit"
        class="w-full bg-green-600 text-white py-2 rounded">
        Check Out
    </button>
</form>
@endif

<script>
const OFFICE_LAT = Number({{ config('attendance.office.lat') ?? 0 }});
const OFFICE_LNG = Number({{ config('attendance.office.lng') ?? 0 }});
const RADIUS     = Number({{ config('attendance.radius') ?? 0 }});

function distanceInMeters(lat1, lng1, lat2, lng2) {
    const R = 6371000;
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLng = (lng2 - lng1) * Math.PI / 180;

    const a =
        Math.sin(dLat / 2) ** 2 +
        Math.cos(lat1 * Math.PI / 180) *
        Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLng / 2) ** 2;

    return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)));
}

document.addEventListener('DOMContentLoaded', function () {

    if (!navigator.geolocation) return;

    navigator.geolocation.getCurrentPosition(
        function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // === SET CHECK-IN INPUT ===
            const latIn = document.getElementById('lat');
            const lngIn = document.getElementById('lng');

            if (latIn && lngIn) {
                latIn.value = lat;
                lngIn.value = lng;

                const info = document.getElementById('location-info');
                const btn  = document.getElementById('checkin-btn');

                if (info && btn) {
                    const distance = distanceInMeters(
                        lat, lng,
                        OFFICE_LAT, OFFICE_LNG
                    );

                    if (distance <= RADIUS) {
                        info.innerHTML = `Great, Dalam area kantor (${Math.round(distance)} m)`;
                        info.className = 'text-sm mb-3 text-green-600';
                        btn.disabled = false;
                    } else {
                        info.innerHTML = `Kamu di luar area kantor (${Math.round(distance)} m)`;
                        info.className = 'text-sm mb-3 text-red-600';
                        btn.disabled = true;
                    }
                }
            }

            // === SET CHECK-OUT INPUT ===
            const latOut = document.getElementById('lat-out');
            const lngOut = document.getElementById('lng-out');

            if (latOut && lngOut) {
                latOut.value = lat;
                lngOut.value = lng;
            }
        },
        function () {
            const info = document.getElementById('location-info');
            if (info) info.innerHTML = '❌ Gagal mengambil lokasi';
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 60000
        }
    );
});
</script>