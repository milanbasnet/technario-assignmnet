@extends('backend.layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="{{ asset('css/aiz-core.css') }}">

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="content-header row">
                    <div class="content-header-left col-lg-7 col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Create Movies</h2>
                            </div>
                        </div>
                    </div>
                    <div
                        class="content-header-right text-sm-start text-md-start text-lg-end col-lg-5 col-md-12 col-12 pr-0">
                        <div class="mb-1 breadcrumb-right">
                            <div class="dropdown">
                                <a href="{{ route('movies') }}" class="btn btn-primary px-1"><i
                                        class="far fa-plus-circle"></i> Movies</a>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="form form-horizontal" id="choice_form" action="{{ route('movie.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Release Date</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ old('date') }}" name="release_date" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="ckeditor" value="{{ old('description') }}" name="description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" name="status" type="checkbox" checked
                                    {{ old('status', isset($project->status) ? $project->status : '') == 'active' ? 'checked' : '' }} />
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formFile" class="form-label">Poster</label>
                        <input class="form-control" name="poster" type="file" id="formFile" accept="image/*">
                    </div>
                    <div class="col-sm- offset-sm-3">
                        <button type="submit"
                            class="btn btn-primary me-1 waves-effect waves-float waves-light">Save</button>
                        <button type="reset" class="btn btn-danger waves-effect">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

<script>
    $(function() {
        $('input[name="release_date"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
        });
        $('input[name="release_date"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY/MM/DD'))
        });
        $('input[name="release_date"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>
