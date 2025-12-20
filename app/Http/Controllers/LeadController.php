<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::with('client')->latest()->paginate(10);
        return view('marketing.leads.index', compact('leads'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('marketing.leads.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:new,contacted,qualified,lost',
        ]);

        Lead::create([
            'client_id' => $request->client_id,
            'title' => $request->title,
            'source' => $request->source,
            'notes' => $request->notes,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('marketing.leads.index')->with('success', 'Lead berhasil ditambahkan.');
    }

    public function edit(Lead $lead)
    {
        $clients = Client::all();
        return view('marketing.leads.edit', compact('lead', 'clients'));
    }

    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:new,contacted,qualified,lost',
        ]);

        $lead->update([
            'client_id' => $request->client_id,
            'title' => $request->title,
            'source' => $request->source,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        return redirect()->route('marketing.leads.index')->with('success', 'Lead berhasil diperbarui.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('marketing.leads.index')->with('success', 'Lead berhasil dihapus.');
    }
}
