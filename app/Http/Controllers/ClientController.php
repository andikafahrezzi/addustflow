<?php
// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Exports\ClientsExport;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->get();
        return view('marketing.index', compact('clients'));
    }

    public function create()
    {
        return view('marketing.create'); // kalau kamu belum punya, kasih tahu saya, saya buatkan
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable'
        ]);

        Client::create([
    'name'       => $request->name,
    'email'      => $request->email,
    'phone'      => $request->phone,
    'address'    => $request->address,
    'company'    => $request->company,
    'created_by' => Auth::id(),
]);


        return redirect()->route('marketing.clients.index')
            ->with('success', 'Client berhasil ditambahkan.');
    }

    public function export()
    {
        return Excel::download(new ClientsExport, 'clients.xlsx');
    }
    public function edit($id)
{
    $client = Client::findOrFail($id);
    return view('marketing.edit', compact('client'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'nullable|email',
        'phone' => 'nullable'
    ]);

    $client = Client::findOrFail($id);

    $client->update([
        'name'    => $request->name,
        'email'   => $request->email,
        'phone'   => $request->phone,
        'address' => $request->address,
        'company' => $request->company,
    ]);

    return redirect()->route('marketing.clients.index')
                     ->with('success', 'Client berhasil diperbarui.');
}

public function destroy($id)
{
    $client = Client::findOrFail($id);
    $client->delete();

    return redirect()->route('marketing.clients.index')
                     ->with('success', 'Client berhasil dihapus.');
}

}
