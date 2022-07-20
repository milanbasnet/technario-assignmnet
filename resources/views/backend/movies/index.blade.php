@extends('backend.layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header py-1 d-flex justify-content-between">
              <a href="{{route('movie.create')}}" data-toggle="tooltip" data-placement="top" title="Export to csv">
                <button type="button" class="btn btn-primary">Add New</button>
              </a>
          </div>
          <div class="card-content">
              <div class="table-responsive">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>S.N.</th>
                              <th>Title</th>
                              <th>Poster</th>
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
                              <td>
                                <div class="row">
                                    <div class="col-md-3" style="overflow: hidden">
                                        @if ($movie->poster)
                                            <img src="{{ asset('/poster/'.$movie->poster) }}" height="50" loading="lazy">
                                        @endif
                                    </div>
                                </div>
                              </td>
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
                              <td style="min-width: 70px">
                                    <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-sm btn-primary" title="Edit">Edit</a>
                                    <form action="{{ route('movie.destroy', $movie->id) }}" method="post" style="display: inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('are you sure to delete?')" title="Delete">
                                            Delete
                                        </button>
                                    </form>
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
