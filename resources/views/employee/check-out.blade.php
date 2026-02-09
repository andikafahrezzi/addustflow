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
        <input type="file" name="photo" accept="image/*" capture="user" required>
    </div>

    <button
        class="w-full bg-green-600 text-white py-2 rounded">
        Check Out
    </button>
</form>
@endif

<script>
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            const latIn = document.getElementById('lat');
            const lngIn = document.getElementById('lng');
            const info = document.getElementById('location-info');
            const btn = document.getElementById('checkin-btn');

            if (latIn && lngIn) {
                latIn.value = lat;
                lngIn.value = lng;

                info.innerHTML = `📍 Lokasi terdeteksi`;
                info.classList.add('text-green-600');
                btn.disabled = false;
            }

            const latOut = document.getElementById('lat-out');
            const lngOut = document.getElementById('lng-out');
            if (latOut && lngOut) {
                latOut.value = lat;
                lngOut.value = lng;
            }
        },
        function() {
            document.getElementById('location-info').innerHTML =
                '❌ Gagal mengambil lokasi';
        }
    );
} else {
    alert('Browser tidak mendukung GPS');
}
</script>