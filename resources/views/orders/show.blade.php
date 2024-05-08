@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-store text-yellow"></i> <strong>Stock Management</strong> | Order Process</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Stock Management</strong> > <i class="nav-icon fas fa-shopping-bag text-yellow"></i> Order Approval</h6>
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
                    <form action="{{ route('orders.approve', $order->id) }}" method="POST">
                        @csrf
{{--                        @method('PUT')--}}
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="customer_id" class="col-sm-2 col-form-label">Customer</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $order->customer->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="date" class="col-sm-4 col-form-label">Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="date" class="form-control" value="{{ $order->date }}" readonly>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label class="col-sm-4 col-form-label">Order No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ $order->order_no }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="files" class="col-form-label">Uploaded File</label>
                                    @if ($order->files)
                                        <p>Current File: <a href="{{ asset('storage/' . $order->files) }}" target="_blank"><i class="fas fa-file-download"></i></a></p>
                                    @else
                                        <p>No file uploaded</p>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="date" class="col-sm-4 col-form-label">Remarks</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="remarks" class="form-control" value="{{ $order->remarks }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-center">
                                    <th style="width: 20px">No</th>
                                    <th>Service</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($order->details as $detail)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td>{{ $detail->services->name ?? '-' }}</td>
                                        <td class="text-center">{{ $detail->quantity ?? '-' }}</td>
                                        <td class="text-right">{{ number_format($detail->unit_price, 2) ?? '-' }}</td>
                                        <td class="text-right">{{ number_format($detail->total, 2) ?? '-' }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" ><strong>Total Amount</strong></td>
                                    <td class="text-right">{{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><strong>Discount</strong></td>
                                    <td class="text-right">{{ number_format($order->discount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><strong>Net Amount</strong></td>
                                    <td class="text-right">{{ number_format($order->total_amount - ($order->total_amount * $order->discount/100), 2) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-center">
                            @if($order->status != 0)
                                <button type="submit" name="approval" value="approve" class="btn btn-sm btn-outline-success">Approve</button>
                                <button type="submit" name="approval" value="Forward" class="btn btn-sm btn-outline-warning">Forward</button>
                                <button type="submit" name="approval" value="reject" class="btn btn-sm btn-outline-danger"
                                        @if($order->status == 2) disabled @endif>Reject</button>
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
