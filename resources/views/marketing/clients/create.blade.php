@extends('layouts.marketing')

@section('title', 'Campaign Dashboard')
@section('page-title', 'Campaign Overview')

@section('content')
    <div class="container">

    <h2 class="mb-4">Tambah Client</h2>

    <form action="{{ route('marketing.clients.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label>Perusahaan</label>
            <input type="text" name="company" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('marketing.clients.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection


