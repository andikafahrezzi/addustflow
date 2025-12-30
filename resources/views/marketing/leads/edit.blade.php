@extends('layouts.marketing')

@section('title', 'Campaign Dashboard')
@section('page-title', 'Campaign Overview')

@section('content')
<h1>Edit Lead</h1>
<form action="{{ route('marketing.leads.update', $lead) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Client</label>
        <select name="client_id" class="form-control">
            @foreach($clients as $client)
                <option value="{{ $client->id }}" @selected($lead->client_id == $client->id)>{{ $client->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ $lead->title }}">
    </div>
    <div class="mb-3">
        <label>Source</label>
        <input type="text" name="source" class="form-control"value="{{ $lead->source }}">
    </div>>
    </div>
    <div class="mb-3">
        <label>Notes</label>
        <textarea name="notes" class="form-control">{{ $lead->notes }}</textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            @foreach(['new','contacted','qualified','lost'] as $status)
                <option value="{{ $status }}" @selected($lead->status == $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection


