@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-address-card text-blue"></i> <strong>Master Data</strong> | Items
                            Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Master Data</strong> > <i class="nav-icon fas fa-star text-blue"></i> Create Items</h6>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12 text-right">
                        <a href="{{ route('items.index') }}" class="btn btn-sm btn-primary">Back</a>
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
                    <form action="{{ route('items.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="name" class="col-sm-4 col-form-label">Item Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="code" class="col-sm-4 col-form-label">Item Code</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="code" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="category_id" class="col-sm-4 col-form-label">Item Category</label>
                                    <div class="col-sm-8">
                                        @if(isset($categories))
                                            <select name="category_id" class="form-control" data-live-search="true">
                                                <option selected>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="category_id" class="col-sm-4 col-form-label">Measure Unit</label>
                                    <div class="col-sm-8">
{{--                                        @if(isset($categories))--}}
{{--                                            <select name="category_id" class="form-control" data-live-search="true">--}}
{{--                                                <option selected>Select Category</option>--}}
{{--                                                @foreach($categories as $category)--}}
{{--                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="quantity" class="col-sm-4 col-form-label">Quantity</label>
                                    <div class="col-sm-8">
                                        <input type="number" min="1" name="quantity" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="quantity_alert" class="col-sm-4 col-form-label">Quantity Alert</label>
                                    <div class="col-sm-8">
                                        <input type="number" min="1" name="quantity_alert" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="buying_price" class="col-sm-4 col-form-label">Buying Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" min="1" name="buying_price" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="selling_price" class="col-sm-4 col-form-label">Selling Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" min="1" name="selling_price" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 row">
                                    <label for="remark" class="col-sm-2 col-form-label">Remarks</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="remark" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
    {{--                        <div class="card-body">--}}
    {{--                            <h3 class="card-title">Item Image</h3>--}}

    {{--                            <div class="small font-italic text-muted mb-2">--}}
    {{--                                JPG or PNG no larger than 2 MB--}}
    {{--                            </div>--}}

    {{--                            <input--}}
    {{--                                type="file"--}}
    {{--                                accept="image/*"--}}
    {{--                                id="image"--}}
    {{--                                name="item_image"--}}
    {{--                                class="form-control @error('item_image') is-invalid @enderror"--}}
    {{--                                onchange="previewImage();"--}}
    {{--                            >--}}

    {{--                            @error('item_image')--}}
    {{--                            <div class="invalid-feedback">--}}
    {{--                                {{ $message }}--}}
    {{--                            </div>--}}
    {{--                            @enderror--}}
    {{--                        </div>--}}
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
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
