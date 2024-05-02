@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Closing Balance Report</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right m-1">
                            <li class="breadcrumb-item">
                                <a href="{{ route('reports.index') }}" class="btn btn-sm btn-dark">Back</a>
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
{{--            <div class="card-header">--}}
{{--                <div class="container-fluid">--}}
{{--                    <form method="GET" action="{{ route('closing-balance') }}">--}}
{{--                        <div class="form-group row">--}}
{{--                            <div class="col-4 row">--}}
{{--                                <label for="year" class="col-sm-4 col-form-label">Year </label>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <input type="number" name="year" class=" col-sm-6 form-control" value="{{ request('year') }}" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 row">--}}
{{--                                <label for="icp_id" class="col-sm-4 col-form-label">Quarter</label>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <select name="icp_id" class="form-control" data-live-search="true" required>--}}
{{--                                        <option selected value="" disabled>Select Quarter</option>--}}
{{--                                        <option value=10>1st Quarter</option>--}}
{{--                                        <option value=20>2nd Quarter</option>--}}
{{--                                        <option value=30>3rd Quarter</option>--}}
{{--                                        <option value=40>4th Quarter</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 row">--}}
{{--                                <label for="regiment_id" class="col-sm-4 col-form-label">Regiment</label>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    @if(isset($items-category))--}}
{{--                                        <select name="regiment_id" class="form-control" data-live-search="true" required>--}}
{{--                                            <option selected>Select Regiment</option>--}}
{{--                                            @foreach($items-category as $regiment)--}}
{{--                                                <option value="{{ $regiment->id }}">{{ $regiment->regiment_name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 text-right">--}}
{{--                            <button type="submit" class="btn btn-sm btn-outline-primary">Process</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="card-body">
                <table class="table table-bordered" id="loans">
                    <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Application No</th>
                        <th>Reg No</th>
                        <th>Name</th>
                        <th>Total Capital</th>
                        <th>Recovered Capital</th>
                        <th>Installment No</th>
                        <th>Installment</th>
                    </tr>
                    </thead>
                    @php
                        $i=0;
                    @endphp
                    <tbody>
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $loan->application_reg_no ?? '-' }}</td>
                            <td>{{ $loan->membership->regimental_number ?? '-'}}</td>
                            <td>{{ $loan->membership->ranks->rank_name ?? '-'}} {{ $loan->membership->name ?? '-'}}</td>
                            <td>{{ number_format($loan->loan->total_capital,2) ?? '-' }}</td>
                            <td>{{ number_format($loan->loan->total_recovered_capital,2) ?? '-' }}</td>
                            <td>{{ $loan->loan->no_of_installments_paid+1 ?? '-' }}</td>
                            <td>{{ number_format($loan->loan->next_installement,2) ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#loans').DataTable({
                    responsive: true,
                    paging: false,
                    // searching: true,
                    info: false,
                    buttons: []
                });
            });

            setTimeout(function () {
                $('.alert').fadeOut();
            }, 4000);
        </script>
@endsection


