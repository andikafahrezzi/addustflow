<h3>Daftar Project</h3>

<table class="table">
    <tr>
        <th>Nama Project</th>
        <th>Manager</th>
        <th>Budget</th>
        <th>Aksi</th>
    </tr>

    @foreach($projects as $p)
    <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->manager->name ?? '-' }}</td>
        <td>{{ number_format($p->budget, 2) }}</td>

        @php
            // invoice untuk client biasanya adalah invoice yang sudah diapprove
            $clientInvoice = $p->invoices
                ->whereIn('status', ['approved', 'paid', 'sent'])
                ->sortByDesc('created_at')->first();
        @endphp

        <td>
            
            <a href="{{ route('finance.invoices.index', $p->id) }}"
                class="btn btn-primary btn-sm">invoice Internal</a>
            @if($clientInvoice)
            <a href="{{ route('finance.payments.index',$clientInvoice->id) }}"
                class="btn btn-primary btn-sm">
                Invoice Client
            </a>
            @endif

            @if($clientInvoice)
            <a href="{{ route('finance.invoices.showClient',$clientInvoice->id) }}"
                class="btn btn-primary btn-sm">
                Invoice Client
            </a>
            @endif
        </td>
    </tr>
    @endforeach
</table>
