@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <img src="{{ $newItem->image }}" class="card-img-top" alt="{{ $newItem->title }}" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h2 class="card-title text-center">{{ $newItem->title }}</h2>
                        <p class="card-text">{{ $newItem->description }}</p>
                        <p class="card-text"><strong>Category:</strong> {{ $newItem->category->name }}</p>
                        <p class="card-text"><strong>{{ $newItem->created_at->diffForHumans() }}</strong></p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Add a Comment</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('new.comment', $newItem->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror" rows="3" required></textarea>
                                @error('comment')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Comments</div>
                    <div class="card-body">
                        @forelse($newItem->comments as $comment)
                            <div class="mb-3">
                                <p class="mb-1"><strong>{{ $comment->created_at->diffForHumans() }}</strong></p>
                                <p>{{ $comment->comment }}</p>
                            </div>
                            <hr>
                        @empty
                            <p>No comments yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
