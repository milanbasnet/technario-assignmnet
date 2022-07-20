@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="table-responsive">
                    @foreach($users as $user)
                    <div>
                        <label for="">User Name: </label>
                        <label for="">{{$user->name}}</label>
                    </div>
                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                        <div class="card-group">
                            @foreach($user->like_movies as $movie)
                            <div class="card">
                                <img src="{{ asset('/poster/'.$movie->poster) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$movie->title}}</h5>
                                    <p class="card-text"><small class="text-muted">{{ $movie->release_date->format('d M, Y') }}</small></p>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer p-50">
                {{ $users->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection