@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Diskon</h2>
    
    <form action="{{ route('diskons.update', [$diskon->product_id, $diskon]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Persentase Diskon (%)</label>
            <input type="number" name="discount_percentage" class="form-control" value="{{ $diskon->discount_percentage }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" value="{{ $diskon->start_date }}" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Akhir</label>
            <input type="date" name="end_date" class="form-control" value="{{ $diskon->end_date }}" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $diskon->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $diskon->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('diskons.index', $diskon->product_id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection