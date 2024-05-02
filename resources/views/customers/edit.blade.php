@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-print text-orange"></i> <strong>Stock Management</strong> | Customers
                            Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Stock Management</strong> > <i class="nav-icon fas fa-star text-orange"></i> Edit Customers</h6>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12 text-right">
                        <a href="{{ route('customers.index') }}" class="btn btn-sm btn-primary"> Back</a>
                    </div>
                </div>
            </div>
        </section>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
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
                    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="name" class="col-sm-4 col-form-label">Customer Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $customer->name }}" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="mobile" class="col-sm-4 col-form-label">Mobile No</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $customer->mobile }}" name="mobile" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ $customer->address }}" name="address" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $customer->email }}" name="email" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="type" class="col-sm-4 col-form-label">Type</label>
                                    <select name="type" class=" col-sm-8 form-control" data-live-search="true">
                                        <option selected>Select Type</option>
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="rare">Rare</option>
                                    </select>
                                </div>
                                <div class="col-6 row">
                                    <label for="account_no" class="col-sm-4 col-form-label">Account No</label>
                                    <div class="col-sm-8">
                                        <input type="number" value="{{ $customer->account_no }}" min="1" name="account_no" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="bank" class="col-sm-4 col-form-label">Bank Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $customer->bank }}" name="bank" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="bank_branch" class="col-sm-4 col-form-label">Bank Branch</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $customer->bank_branch }}" name="bank_branch" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="card-body">--}}
                        {{--                            <h3 class="card-title">Customer Image</h3>--}}

                        {{--                            <div class="small font-italic text-muted mb-2">--}}
                        {{--                                JPG or PNG no larger than 2 MB--}}
                        {{--                            </div>--}}

                        {{--                            <input--}}
                        {{--                                type="file"--}}
                        {{--                                accept="image/*"--}}
                        {{--                                id="image"--}}
                        {{--                                name="customer_image"--}}
                        {{--                                class="form-control @error('customer_image') is-invalid @enderror"--}}
                        {{--                                onchange="previewImage();"--}}
                        {{--                            >--}}

                        {{--                            @error('customer_image')--}}
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
