
<div class="container">

    <h2 class="mb-4">Edit Client</h2>

    <form action="{{ route('marketing.clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ $client->name }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $client->email }}">
        </div>

        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="phone" class="form-control" value="{{ $client->phone }}">
        </div>

        <div class="mb-3">
            <label>Perusahaan</label>
            <input type="text" name="company" class="form-control" value="{{ $client->company }}">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control">{{ $client->address }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('marketing.clients.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>

