<h2>Audit Log</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Waktu</th>
        <th>User</th>
        <th>Aksi</th>
        <th>Modul</th>
        <th>Deskripsi</th>
        <th>IP</th>
    </tr>

    @foreach($logs as $log)
        <tr>
            <td>{{ $log->created_at }}</td>
            <td>{{ $log->user->email ?? 'System' }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ $log->module }}</td>
            <td>{{ $log->description }}</td>
            <td>{{ $log->ip_address }}</td>
        </tr>
    @endforeach
</table>
