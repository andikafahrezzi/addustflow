<h3>Invoices for Project: {{ $project->name }}</h3>

<div class="mb-3">
    <form method="POST" action="{{ route('finance.invoices.approveAll', $project->id) }}">
        @csrf @method('PUT')
        <button class="btn btn-success">Approve All</button>
    </form>
</div>

<div class="card p-3">
    <h5>Expenses Summary (Read Only)</h5>

    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $exp)
            <tr>
                <td>{{ $exp->description }}</td>
                <td>{{ number_format($exp->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <strong>Total Expenses: </strong> 
        {{ number_format($total, 2) }}
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Invoice #</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($invoices as $inv)
        <tr>
            <td>{{ $inv->invoice_number }}</td>
            <td>{{ number_format($inv->amount, 2) }}</td>
            <td>{{ $inv->status }}</td>
            <td>
                <form method="POST" action="{{ route('finance.invoices.approve', $inv->id) }}">
                    @csrf @method('PUT')
                    <button class="btn btn-success btn-sm">Approve</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
