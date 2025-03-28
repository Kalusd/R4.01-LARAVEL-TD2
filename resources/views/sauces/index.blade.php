@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <p class="text-uppercase text-muted">THE SAUCES</p>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        @forelse ($sauces as $sauce)
            <div class="col-md-3 text-center mb-4">
                <a href="{{ route('sauces.show', $sauce->id) }}" class="text-decoration-none">
                    @if ($sauce->imageUrl)
                        <img src="{{ asset('storage/' . $sauce->imageUrl) }}" class="img-fluid" alt="{{ $sauce->name }}" style="max-height: 250px;">
                    @else
                        <img src="https://via.placeholder.com/250" class="img-fluid" alt="Placeholder">
                    @endif

                    <h5 class="fw-bold text-dark mt-3 text-uppercase">{{ $sauce->name }}</h5>
                    <p class="text-muted">Heat: {{ $sauce->heat }}/10</p>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">No sauces found.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection