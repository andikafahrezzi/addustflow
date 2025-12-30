
@extends('layouts.marketing')

@section('title', 'Campaign Dashboard')
@section('page-title', 'Campaign Overview')

@section('content')
<div class="container">
    <h1>Proposals</h1>

    <a href="{{ route('marketing.proposals.create') }}" class="btn btn-primary">Tambah Proposal</a>
    <a href="{{ route('marketing.proposals.exportExcel') }}" class="btn btn-success">Export Excel</a>
    <a href="{{ route('marketing.proposals.exportPDF') }}" class="btn btn-danger">Export PDF</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Lead</th>
                <th>Title</th>
                <th>Estimated Value</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proposals as $proposal)
            <tr>
                <td>{{ $proposal->id }}</td>
                <td>{{ $proposal->lead->title ?? 'N/A' }}</td>
                <td>{{ $proposal->title }}</td>
                <td>{{ number_format($proposal->estimated_value, 2) }}</td>
                <td>{{ $proposal->status }}</td>
                <td>
                    <a href="{{ route('marketing.proposals.edit', $proposal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('marketing.proposals.destroy', $proposal->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


