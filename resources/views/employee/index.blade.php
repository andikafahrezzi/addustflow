{{-- resources/views/employee/attendance/index.blade.php --}}
@extends($layout)

@section('title', 'Absensi Hari Ini')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Absensi Hari Ini</h1>
                <p class="text-sm text-gray-500 mt-0.5">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="flex items-center space-x-3 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="flex items-center space-x-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-medium">{{ $errors->first() }}</span>
        </div>
    @endif

    {{-- Status Card --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Status Kehadiran</h2>

        @if(!$attendance)
            <div class="flex items-center space-x-3">
                <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                <span class="text-gray-600 font-medium">Belum Check-in</span>
            </div>
        @elseif($attendance && !$attendance->check_out_at)
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-xs text-blue-500 font-semibold uppercase tracking-wider mb-1">Status</p>
                    <div class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 bg-blue-500 rounded-full animate-pulse"></span>
                        <span class="font-semibold text-blue-700">Sudah Check-in</span>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Jam Masuk</p>
                    <p class="font-semibold text-gray-800">{{ $attendance->check_in_at }}</p>
                </div>
            </div>
        @else
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-green-50 rounded-lg p-4">
                    <p class="text-xs text-green-500 font-semibold uppercase tracking-wider mb-1">Status</p>
                    <div class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                        <span class="font-semibold text-green-700">Selesai</span>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Jam Masuk</p>
                    <p class="font-semibold text-gray-800">{{ $attendance->check_in_at }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-1">Jam Pulang</p>
                    <p class="font-semibold text-gray-800">{{ $attendance->check_out_at }}</p>
                </div>
            </div>
        @endif
    </div>

    {{-- CHECK-IN FORM --}}
    @if(!$attendance || !$attendance->check_in_at)
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-base font-bold text-gray-800 mb-5 flex items-center space-x-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            <span>Form Check-in</span>
        </h2>

        <form method="POST"
              action="{{ route('attendance.check-in') }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf

            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
            <input type="hidden" name="photo" id="photoInput">

            {{-- Camera Section --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Selfie Check-in
                </label>
                <div class="flex flex-col items-center space-y-3">
                    <div class="relative w-full max-w-xs">
                        <video id="video" autoplay playsinline
                               class="w-full rounded-xl border-2 border-gray-200 bg-gray-100 aspect-video object-cover">
                        </video>
                    </div>
                    <canvas id="canvas" class="hidden"></canvas>

                    <button type="button" id="captureBtn"
                            class="inline-flex items-center space-x-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Ambil Foto</span>
                    </button>

                    <p id="statusText" class="text-sm text-gray-400"></p>
                </div>
            </div>

            {{-- Location Info --}}
            <div id="location-info"
                 class="flex items-center space-x-2 text-sm text-gray-500 bg-gray-50 rounded-lg px-4 py-3">
                <svg class="w-4 h-4 animate-spin text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                <span>Mengambil lokasi...</span>
            </div>

            <button id="checkin-btn"
                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed text-white font-semibold rounded-xl transition-colors"
                    disabled>
                Check In Sekarang
            </button>
        </form>
    </div>
    @endif

    {{-- CHECK-OUT FORM --}}
    @if($attendance && $attendance->check_in_at && !$attendance->check_out_at)
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-base font-bold text-gray-800 mb-5 flex items-center space-x-2">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            <span>Form Check-out</span>
        </h2>

        <form method="POST"
              action="{{ route('attendance.check-out') }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf

            <input type="hidden" name="lat" id="lat-out">
            <input type="hidden" name="lng" id="lng-out">
            <input type="hidden" name="photo" id="photoOut">

            {{-- Camera Section --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Selfie Check-out
                </label>
                <div class="flex flex-col items-center space-y-3">
                    <div class="relative w-full max-w-xs">
                        <video id="videoOut" autoplay playsinline
                               class="w-full rounded-xl border-2 border-gray-200 bg-gray-100 aspect-video object-cover">
                        </video>
                    </div>
                    <canvas id="canvasOut" class="hidden"></canvas>

                    <button type="button" id="captureOutBtn"
                            class="inline-flex items-center space-x-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Ambil Foto</span>
                    </button>

                    <p id="statusOutText" class="text-sm text-gray-400"></p>
                </div>
            </div>

            <button type="submit"
                    class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-colors">
                Check Out Sekarang
            </button>
        </form>
    </div>
    @endif

</div>

{{-- ======= SCRIPTS TIDAK DIUBAH SAMA SEKALI ======= --}}
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

@endsection