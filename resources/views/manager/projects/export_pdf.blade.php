<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Client</th>
        <th>Manager</th>
        <th>Value</th>
        <th>Status</th>
    </tr>

    @foreach($projects as $p)
    <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->client->name }}</td>
        <td>{{ $p->manager->name }}</td>
        <td>{{ number_format($p->contract_value) }}</td>
        <td>{{ $p->status }}</td>
    </tr>
    @endforeach
</table>
