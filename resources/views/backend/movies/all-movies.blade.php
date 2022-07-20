@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Release Date</th>
                                <th>Likes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movies as $movie)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td> {{ $movie->title }}</td>
                                <td> {!! $movie->description !!}</td>
                                <td>
                                    @if($movie->status == 'publish')
                                    <span>Publish</span>
                                    @else
                                    <span>Unpublish</span>
                                    @endif
                                </td>
                                <td> {{ $movie->release_date->format('d M, Y') }}</td>
                                <td> {{ $movie->likes }}</td>
                                <td>
                                    @if ($movie->status == 'unpublish')
                                    <form action="{{ route('movie.publish', $movie->id) }}" method="post" style="display: inline">
                                        @csrf
                                        <button class="btn btn-icon btn-sm d-flex align-items-center btn-outline-success round waves-effect waves-light" type="submit" onclick="return confirm('are you sure to publish?')" data-toggle="tooltip" data-placement="top" title="Publish">
                                            <i data-feather="check-circle" class="me-50"></i>Publish
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer p-50">
                {{ $movies->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection