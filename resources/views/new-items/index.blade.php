@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($newItems as $newItem)
                @php
                    // Check if $newItem->image starts with 'http' or 'https'
                    $isExternal = Str::startsWith($newItem->image, ['http://', 'https://']);
                @endphp
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $isExternal ? $newItem->image : asset('storage/' . $newItem->image) }}" class="card-img-top" alt="{{ $newItem->title }}">
                        <div class="card-body">
                            <h2 class="card-title text-center">{{ $newItem->title }}</h2>
                            <p class="card-text">{{ Str::limit($newItem->description, 100) }}</p>
                            <p class="card-text"><strong>category:</strong> {{ $newItem->category->name }}</p>
                            <p class="card-text">
                                <strong>{{ $newItem->created_at->diffForHumans() }}</strong> |
                                {{ $newItem->comments_count }} {{ Str::plural('Comment', $newItem->comments_count) }}
                            </p>
                            <a href="{{ route('news.comments', $newItem->id) }}" class="btn btn-danger text-center">read more </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $newItems->links() }}
        </div>
    </div>
@endsection
