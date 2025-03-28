@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    @if ($sauce->imageUrl)
        <img src="{{ asset('storage/' . $sauce->imageUrl) }}" class="img-fluid d-block mx-auto" alt="{{ $sauce->name }}" style="max-height: 250px;">
    @else
        <img src="https://via.placeholder.com/250" class="img-fluid d-block mx-auto" alt="Placeholder">
    @endif

    <h1 class="card-title text-center fw-bold mb-4">{{ $sauce->name }}</h1>
    <p class="card-text"><strong>Manufacturer:</strong> {{ $sauce->manufacturer }}</p>
    <p class="card-text"><strong>Description:</strong> {{ $sauce->description }}</p>
    <p class="card-text"><strong>Main Pepper:</strong> {{ $sauce->mainPepper }}</p>
    <p class="card-text"><strong>Heat:</strong> {{ $sauce->heat }}/10</p>

    <form action="{{ route('sauces.like', $sauce->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-success">👍 {{ $sauce->likes }}</button>
    </form>
    <form action="{{ route('sauces.dislike', $sauce->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-danger">👎 {{ $sauce->dislikes }}</button>
    </form>


    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('sauces.index') }}" class="btn btn-secondary">All Sauces</a>
        <a href="{{ route('sauces.edit', $sauce->id) }}" class="btn btn-primary">Edit Sauce</a>

        <form action="{{ route('sauces.destroy', $sauce->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sauce?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Sauce</button>
        </form>
    </div>
</div>
@endsection