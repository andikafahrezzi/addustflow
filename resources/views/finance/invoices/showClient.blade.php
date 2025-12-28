<div class="container">
    <h3>Detail Invoice: {{ $invoice->invoice_number }}</h3>

    <p><strong>Project:</strong> {{ $project->name }}</p>
    <p><strong>Status:</strong> {{ $invoice->status }}</p>
    <p><strong>Total Amount:</strong> {{ number_format($invoice->amount,2) }}</p>

    @if($invoice->notes)
        <p><strong>Notes:</strong> {{ $invoice->notes }}</p>
    @endif

    <hr>

    <h4>Expenses (Readonly)</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody>
            @foreach($expenses as $ex)
            <tr>
                <td>{{ $ex->description }}</td>
                <td>{{ number_format($ex->amount,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    {{-- ACTION BUTTONS --}}
    @if($invoice->status === 'draft')
        <form action="{{ route('finance.invoices.approve',$invoice->id) }}" method="POST">
            @csrf
            <button class="btn btn-success">Approve</button>
        </form>

    @elseif($invoice->status === 'approved')
        <form action="{{ route('finance.invoices.send',$invoice->id) }}" method="POST">
            @csrf
            <button class="btn btn-info">Send to Client</button>
        </form>

    @elseif($invoice->status === 'sent')
        <form action="{{ route('finance.invoices.paid',$invoice->id) }}" method="POST">
            @csrf
            <button class="btn btn-primary">Mark as Paid</button>
        </form>
    @endif
</div>
