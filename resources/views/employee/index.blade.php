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
    <input type="hidden" name="photo" id="photoInput">

    <div class="mb-3">
        <label class="block text-sm font-semibold mb-2">Selfie Check-in</label>

        <video id="video" autoplay playsinline class="w-64 rounded border"></video>

        <canvas id="canvas" class="hidden"></canvas>

        <button type="button"
                id="captureBtn"
                class="mt-3 px-4 py-2 bg-blue-600 text-white rounded">
            Ambil Foto
        </button>

        <p id="statusText" class="text-sm text-gray-500 mt-2"></p>
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
    <input type="hidden" name="photo" id="photoOut">

    <div class="mb-3">
        <label class="block text-sm font-semibold mb-2">Selfie Check-out</label>

        <video id="videoOut" autoplay playsinline class="w-64 rounded border"></video>
        <canvas id="canvasOut" class="hidden"></canvas>

        <button type="button"
                id="captureOutBtn"
                class="mt-3 px-4 py-2 bg-blue-600 text-white rounded">
            Ambil Foto
        </button>

        <p id="statusOutText" class="text-sm text-gray-500 mt-2"></p>
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('captureBtn');
    const photoInput = document.getElementById('photoInput');
    const latInput = document.getElementById('lat');
    const lngInput = document.getElementById('lng');
    const statusText = document.getElementById('statusText');
    const checkinBtn = document.getElementById('checkin-btn');

    if (!video || !captureBtn) return;

    navigator.mediaDevices.getUserMedia({
        video: { facingMode: "user" }
    })
    .then(stream => {
        video.srcObject = stream;
    })
    .catch(err => {
        alert("Tidak bisa mengakses kamera");
        console.log(err);
    });

    captureBtn.addEventListener('click', function () {

        if (!video.videoWidth) {
            alert("Kamera belum siap");
            return;
        }

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0);

        ctx.fillStyle = "rgba(0,0,0,0.6)";
        ctx.fillRect(0, canvas.height - 110, canvas.width, 110);

        ctx.fillStyle = "white";
        ctx.font = "18px Arial";

        const now = new Date();
        const timeString = now.toLocaleString();

        const lat = latInput ? latInput.value : '-';
        const lng = lngInput ? lngInput.value : '-';

        ctx.fillText("PT MY PERUSAHAAN", 20, canvas.height - 75);
        ctx.fillText(timeString, 20, canvas.height - 45);
        ctx.fillText("Lat: " + lat + " | Lng: " + lng, 20, canvas.height - 15);

        const dataURL = canvas.toDataURL('image/jpeg', 0.7);

        if (photoInput) photoInput.value = dataURL;

        if (statusText)
            statusText.innerText = "Foto siap dikirim ✔";

        if (checkinBtn)
            checkinBtn.disabled = false;
    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const video = document.getElementById('videoOut');
    const canvas = document.getElementById('canvasOut');
    const captureBtn = document.getElementById('captureOutBtn');
    const photoInput = document.getElementById('photoOut');
    const latInput = document.getElementById('lat-out');
    const lngInput = document.getElementById('lng-out');
    const statusText = document.getElementById('statusOutText');
    const checkoutBtn = document.getElementById('checkout-btn');

    if (!video || !captureBtn) return;

    navigator.mediaDevices.getUserMedia({
        video: { facingMode: "user" }
    })
    .then(stream => {
        video.srcObject = stream;
    })
    .catch(err => {
        console.log(err);
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            latInput.value = position.coords.latitude;
            lngInput.value = position.coords.longitude;
        });
    }

    captureBtn.addEventListener('click', function () {

        if (!video.videoWidth) {
            alert("Kamera belum siap");
            return;
        }

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0);

        ctx.fillStyle = "rgba(0,0,0,0.6)";
        ctx.fillRect(0, canvas.height - 110, canvas.width, 110);

        ctx.fillStyle = "white";
        ctx.font = "18px Arial";

        const now = new Date();
        const timeString = now.toLocaleString();

        ctx.fillText("PT MY PERUSAHAAN", 20, canvas.height - 75);
        ctx.fillText(timeString, 20, canvas.height - 45);
        ctx.fillText(
            "Lat: " + latInput.value + " | Lng: " + lngInput.value,
            20,
            canvas.height - 15
        );

        const dataURL = canvas.toDataURL('image/jpeg', 0.7);

        photoInput.value = dataURL;

        statusText.innerText = "Foto siap dikirim ✔";
        if (checkoutBtn) {
            checkoutBtn.disabled = false;
        }
    });

});
</script>