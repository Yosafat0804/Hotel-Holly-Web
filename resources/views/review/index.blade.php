@extends('layouts.template')

@section('content')
<section class="accomodation_area section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="section-heading mb-4">
                    <h2 class="text-center">
                        Write a review
                        <i class="fas fa-pen"></i>
                    </h2>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @auth
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="content">Your Review</label>
                            <textarea name="content" id="content" class="form-control" required rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit Review</button>
                    </form>
                @else
                    <div class="alert alert-warning text-center">
                        Please <a href="{{ route('login') }}">login</a> to write a review.
                    </div>
                @endauth
            </div>
        </div>
    </div>

    {{-- Show latest 5 reviews --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center mb-4">Latest Reviews</h3>
                @if($reviews->isEmpty())
                    <p class="text-center">No reviews yet.</p>
                @else
                    @foreach($reviews as $review)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $review->email }}</h5>
                                <p class="card-text">{{ $review->content }}</p>
                                <p class="card-text"><small class="text-muted">{{ $review->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
