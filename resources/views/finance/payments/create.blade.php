<h3>Tambah Payment untuk Invoice #{{ $invoice->invoice_number }}</h3>

<form action="{{ route('finance.payments.store', $invoice->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Amount</label>
        <input type="number" name="amount" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Pembayaran</label>
        <input type="date" name="payment_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Metode Pembayaran</label>
        <input type="text" name="method" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
