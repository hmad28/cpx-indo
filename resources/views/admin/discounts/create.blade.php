@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Diskon untuk {{ $product->name }}</h2>
    
    <form action="{{ route('diskons.store', $product->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Persentase Diskon (%)</label>
            <input type="number" name="discount_percentage" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Akhir</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('diskons.index', $product->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection