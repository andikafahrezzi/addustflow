<h3>Create Invoice for Project: {{ $project->name }}</h3>

<form method="POST" action="{{ route('manager.invoices.store', $project->id) }}">
    @csrf

    <h5>Expenses Summary</h5>

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
        <label>Total Amount</label>
        <input type="text" class="form-control" value="{{ $total }}" readonly>
    </div>

    <button class="btn btn-success mt-3">Send Invoice</button>
</form>
