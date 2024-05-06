@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-store text-yellow"></i> <strong>Stock Management</strong> | Workers
                            Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Stock Management</strong> > <i class="nav-icon fas fa-users text-yellow"></i> Create Workers</h6>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12 text-right">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-warning">Back</a>
                    </div>
                </div>
            </div>
        </section>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="container-fluid">
                    <form action="{{ route('workers.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="service_no" class="col-sm-4 col-form-label" >Service No</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ old('service_no') }}" name="service_no" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="rank" class="col-sm-4 col-form-label">Rank</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ old('rank') }}" name="rank" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="name" class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ old('name') }}" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="regiment" class="col-sm-4 col-form-label">Regiment</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ old('regiment') }}" name="regiment" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="mobile" class="col-sm-4 col-form-label">Mobile No</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ old('mobile') }}" name="mobile" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="status" class="col-sm-4 col-form-label">Active</label>
                                    <div class="col-sm-8">
                                        <select name="status" class=" col-sm-6 form-control" data-live-search="true">
                                            <option selected>Select Status</option>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
    {{--                        <div class="card-body">--}}
    {{--                            <h3 class="card-title">Worker Image</h3>--}}

    {{--                            <div class="small font-italic text-muted mb-2">--}}
    {{--                                JPG or PNG no larger than 2 MB--}}
    {{--                            </div>--}}

    {{--                            <input--}}
    {{--                                type="file"--}}
    {{--                                accept="image/*"--}}
    {{--                                id="image"--}}
    {{--                                name="worker_image"--}}
    {{--                                class="form-control @error('worker_image') is-invalid @enderror"--}}
    {{--                                onchange="previewImage();"--}}
    {{--                            >--}}

    {{--                            @error('worker_image')--}}
    {{--                            <div class="invalid-feedback">--}}
    {{--                                {{ $message }}--}}
    {{--                            </div>--}}
    {{--                            @enderror--}}
    {{--                        </div>--}}
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-outline-warning btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                $('.alert').fadeOut();
            }, 4000);
        });
    </script>
@endsection
