@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Vendor</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama PIC:</strong> {{ $vendor->pic_name }}</p>
            <p><strong>Email:</strong> {{ $vendor->email }}</p>
            <p><strong>Telepon:</strong> {{ $vendor->phone }}</p>
            <p><strong>Setuju Syarat:</strong> {{ $vendor->terms_agreed ? 'Ya' : 'Tidak' }}</p>
            <p><strong>Dibuat pada:</strong> {{ $vendor->created_at->format('d-m-Y H:i') }}</p>
            @if($vendor->document_file)
    <div class="mt-4">
        <a href="{{ asset('storage/' . $vendor->document_file) }}" target="_blank" class="btn btn-primary">
            Lihat Dokumen Terunggah
        </a>
    </div>
@endif
        </div>
    </div>
</div>
@endsection
