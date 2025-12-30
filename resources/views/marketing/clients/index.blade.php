@extends('layouts.marketing')

@section('title', 'Campaign Dashboard')
@section('page-title', 'Campaign Overview')

@section('content')
    <div class="container">

    <h2 class="mb-4">Data Clients</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('marketing.clients.create') }}" class="btn btn-primary mb-3">Tambah Client</a>
    <a href="{{ route('marketing.clients.export') }}" class="btn btn-success mb-3">Export Excel</a>

    <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Perusahaan</th>
                    <th>Alamat</th>
                    <th>Dibuat Oleh</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
        </thead>

        <tbody>
            @forelse ($clients as $client)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->company }}</td>
                    <td>{{ $client->address }}</td>
                    <td>{{ $client->creator->name ?? '-' }}</td>
                    <td>{{ $client->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('marketing.clients.edit', $client->id) }}" 
                        class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('marketing.clients.destroy', $client->id) }}" 
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center">Belum ada client</td></tr>
            @endforelse
        </tbody>

    </table>

</div>
@endsection


