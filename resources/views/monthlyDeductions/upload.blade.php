@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Upload Contribution</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right m-1">
                            <li class="breadcrumb-item">
                                <a href="{{ route('monthlyDeductions.index') }}" class="btn btn-sm btn-dark">Back</a>
                            </li>
                        </ol>
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
                    <form method="POST" action="{{ route('upload-xml') }}" enctype="multipart/form-data" id="upload-form">
                        @csrf
                        <div class="form-group">
                            <label for="xml_file">Upload XML File:</label>
                            <input type="file" name="xml_file" id="xml_file" class="form-control" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-6 row">
                                <label for="deposit_year" class="col-sm-4 col-form-label">Deposit Year:</label>
                                <div class="col-sm-8">
                                    <input type="number" name="deposit_year" value="{{ date('Y') }}" class=" col-sm-4 form-control" required>
                                </div>
                            </div>
                            <div class="col-6 row">
                                <label for="deposit_month" class="col-sm-4 col-form-label">Deposit Month:</label>
                                <div class="col-sm-8">
                                    <input type="number" min="1" max="12" name="deposit_month" value="{{ date('m') }}" class="col-sm-4 form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <button id="upload-button" type="submit" class="btn btn-sm btn-outline-primary">Upload and Process XML</button>
                        </div>
                    </form>
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


