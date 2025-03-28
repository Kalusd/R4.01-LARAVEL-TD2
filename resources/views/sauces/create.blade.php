@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 text-center">Create Hot Sauce</h2>

            <form action="{{ route('sauces.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
                @csrf
                <input type="hidden" name="userId" value="{{ Auth::id() }}">

                <div class="mb-1">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter the sauce name" required>
                </div>

                <div class="mb-1">
                    <label for="manufacturer" class="form-label">Manufacturer</label>
                    <input type="text" name="manufacturer" id="manufacturer" class="form-control" placeholder="Enter the manufacturer name" required>
                </div>

                <div class="mb-1">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Describe the sauce" required></textarea>
                </div>

                <div class="mb-1">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-1">
                    <label for="mainPepper" class="form-label">Main Pepper Ingredient</label>
                    <input type="text" name="mainPepper" id="mainPepper" class="form-control" placeholder="Enter the main pepper" required>
                </div>

                <div class="mb-4">
                    <label for="heat" class="form-label">Heat (1-10)</label>
                    <div class="d-flex gap-3 align-items-center">
                        <input type="range" name="heat" id="heat" class="form-range flex-grow-1" min="1" max="10" value="5" required>
                        <input type="number" id="range-display" class="form-control w-auto" min="1" max="10" value="5" required>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Submit</button>
                </div>

                <script>
                    const rangeInput = document.getElementById('heat');
                    const displayInput = document.getElementById('range-display');

                    rangeInput.addEventListener('input', function() {
                        displayInput.value = rangeInput.value;
                    });

                    displayInput.addEventListener("input", function() {
                        if (displayInput.value >= 1 && displayInput.value <= 10) {
                            rangeInput.value = displayInput.value;
                        }
                    });
                </script>
            </form>
        </div>
    </div>
</div>
@endsection