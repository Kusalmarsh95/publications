@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-store text-yellow"></i> <strong>Stock Management</strong> | Issues Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Stock Management</strong> > <i class="nav-icon fas fa-shopping-bag text-yellow"></i> Issues Approval </h6>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12 text-right">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning">Back</a>
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
                    <form action="{{ route('issues.approve', $issue->id) }}" method="POST">
                        @csrf
{{--                        @method('PUT')--}}
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="supplier_id" class="col-sm-2 col-form-label">Supplier</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="issue_no" class="form-control" value="{{ $issue->worker->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="date" class="col-sm-4 col-form-label">Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="date" class="form-control" value="{{ $issue->date }}" readonly>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="issue_no" class="col-sm-4 col-form-label">Bill No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="issue_no" class="form-control" value="{{ $issue->issue_no }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 20px">No</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($issue->details as $detail)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td>{{ $detail->items->name ?? '-' }}</td>
                                        <td class="text-center">{{ $detail->quantity ?? '-' }}</td>
                                        <td class="text-right">{{ number_format($detail->unit_price, 2) ?? '-' }}</td>
                                        <td class="text-right">{{ number_format($detail->total, 2) ?? '-' }}</td>
                                    </tr>
                                @endforeach
{{--                                <tr>--}}
{{--                                    <td colspan="4" ><strong>Total Amount</strong></td>--}}
{{--                                    <td class="text-right">{{ number_format($issue->total_items, 2) }}</td>--}}
{{--                                </tr>--}}
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 text-right">
                            @if($issue->status != 0)
                                <button type="submit" name="approval" value="approve" class="btn btn-sm btn-outline-success">Approve</button>
                                <button type="submit" name="approval" value="reject" class="btn btn-sm btn-outline-danger"
                                        @if($issue->status == 2) disabled @endif>Reject</button>
                            @endif
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
