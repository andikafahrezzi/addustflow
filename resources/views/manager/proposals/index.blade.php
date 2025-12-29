<div class="container">
    <h2>Daftar Proposal</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <!-- Tabel 1: Proposal Submitted (bisa di-approve/reject) -->
    <h3 class="mt-4">Proposal Submitted (Menunggu Approval)</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Client</th>
                <th>Estimasi Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proposals->where('status', 'submitted') as $proposal)
            <tr>
                <td>{{ $proposal->title }}</td>
                <td>{{ $proposal->lead->client->name }}</td>
                <td>Rp {{ number_format($proposal->estimated_value, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('manager.proposals.approve', $proposal->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>
                    <form action="{{ route('manager.proposals.reject', $proposal->id) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($proposals->where('status', 'submitted')->count() == 0)
        <div class="alert alert-info">
            Tidak ada proposal yang sedang menunggu approval.
        </div>
    @endif
    
    <!-- Tabel 2: Proposal Approved/Rejected (history) -->
    <h3 class="mt-5">Proposal yang Sudah Diproses</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Client</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proposals->whereIn('status', ['approved', 'rejected']) as $proposal)
            <tr>
                <td>{{ $proposal->title }}</td>
                <td>{{ $proposal->lead->client->name }}</td>
                <td>
                    @if($proposal->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>
                <td>{{ $proposal->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>