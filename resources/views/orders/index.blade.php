@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-print text-orange"></i> <strong>Publication Management</strong> | Order
                            Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Publication Management</strong> > <i class="nav-icon fas fa-users text-orange"></i> Create Order</h6>
                    </div>
                </div>
                <div class="row mb-2">
{{--                    @can('master-data-orders-create')--}}
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-sm bg-yellow" href="{{ route('orders.create') }}"><i class="nav-icon fas fa-shopping-bag"></i> Create Order</a>
                        </div>
{{--                    @endcan--}}
                </div>
            </div>
        </section>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            @if(Auth::user()->name == 'Publication OC')
                <button class="tab-link" onclick="openPage('All', this, '#3e7d2c')">All</button>
            @endif
            <button class="tab-link" onclick="openPage('MyOrders', this, '#3e7d2c')" id="defaultOpen">My Orders</button>
            <button class="tab-link" onclick="openPage('Assign', this, '#3e7d2c')">Assign To Me</button>
            <div id="All" class="tab-content">
                <table class="table table-bordered " id="all">
                    <thead>
                    <tr class="text-center">
                        <th style="width: 20px">No</th>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Assignee</th>
                        <th>Amount</th>
                        <th class="text-center" style="width: 120px">Action</th>
                    </tr>
                    </thead>
                    @php
                        $i=0;
                    @endphp
                    <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $order->order_no ?? '-' }}</td>
                            <td>{{ $order->customer->name ?? '-' }}</td>
                            <td>{{ $order->date ?? '-' }}</td>
                            <td>
                                @if($order->status === 0)
                                    <label class="badge badge-success">Delivered</label>
                                @elseif($order->status === 1)
                                    <label class="badge badge-warning">Pending</label>
                                @elseif($order->status === 2)
                                    <label class="badge badge-danger">Rejected</label>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $order->assignee }}</td>
                            <td>{{ number_format($order->total_amount,2) ?? '-' }}</td>
                            <td class="text-center">
                                <a class="btn" href="{{ route('orders.show', $order->id) }}">
                                    <i class="fas fa-eye" style="color: rosybrown;"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="MyOrders" class="tab-content">
                <table class="table table-bordered " id="my">
                    <thead>
                    <tr class="text-center">
                        <th style="width: 20px">No</th>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Assignee</th>
                        <th>Amount</th>
                        <th class="text-center" style="width: 120px">Action</th>
                    </tr>
                    </thead>
                    @php
                        $i=0;
                    @endphp
                    <tbody>
                    @foreach ($orders as $order)
                        @if($order->customer_id == Auth::user()->name)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $order->order_no ?? '-' }}</td>
                            <td>{{ $order->customer->name ?? '-' }}</td>
                            <td>{{ $order->date ?? '-' }}</td>
                            <td>
                                @if($order->status === 0)
                                    <label class="badge badge-success">Delivered</label>
                                @elseif($order->status === 1)
                                    <label class="badge badge-warning">Pending</label>
                                @elseif($order->status === 2)
                                    <label class="badge badge-danger">Rejected</label>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $order->assignee }}</td>
                            <td>{{ number_format($order->total_amount,2) ?? '-' }}</td>
                            <td class="text-center">
                                <a class="btn" href="{{ route('orders.show', $order->id) }}">
                                    <i class="fas fa-eye" style="color: rosybrown;"></i>
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="Assign" class="tab-content">
                <table class="table table-bordered " id="assign">
                    <thead>
                    <tr class="text-center">
                        <th style="width: 20px">No</th>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Assignee</th>
                        <th>Amount</th>
                        <th class="text-center" style="width: 120px">Action</th>
                    </tr>
                    </thead>
                    @php
                        $i=0;
                    @endphp
                    <tbody>
                    @foreach ($orders as $order)
                        @if($order->assignee == Auth::user()->name)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $order->order_no ?? '-' }}</td>
                            <td>{{ $order->customer->name ?? '-' }}</td>
                            <td>{{ $order->date ?? '-' }}</td>
                            <td>
                                @if($order->status === 0)
                                    <label class="badge badge-success">Delivered</label>
                                @elseif($order->status === 1)
                                    <label class="badge badge-warning">Pending</label>
                                @elseif($order->status === 2)
                                    <label class="badge badge-danger">Rejected</label>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $order->assignee }}</td>
                            <td>{{ number_format($order->total_amount,2) ?? '-' }}</td>
                            <td class="text-center">
                                <a class="btn" href="{{ route('orders.show', $order->id) }}">
                                    <i class="fas fa-eye" style="color: rosybrown;"></i>
                                </a>
                                @can('publication-management-orders-edit')
                                    <a class="btn" href="{{ route('orders.edit', $order->id) }}">
                                        <i class="fas fa-pen" style="color: lightseagreen;"></i>
                                    </a>
                                @endcan
                                @can('publication-management-orders-delete')
                                    <button class="btn delete-button" data-id="{{ $order->id }}">
                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this member?
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn cancel-button btn-secondary">Cancel</button>
                    <form id="deleteorderForm" method="POST" action="">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#all').DataTable({
                responsive: true,
                // searching:false,
                buttons: [],
                // paging: false,
                // info: false,
            });
            $('#my').DataTable({
                responsive: true,
                // searching:false,
                buttons: [],
                // paging: false,
                // info: false,
            });
            $('#assign').DataTable({
                responsive: true,
                // paging: false,
                // info: false,
                buttons: [
                ]
            });

            $(document).on('click', '.delete-button', function () {
                var orderId = $(this).data('id');
                var form = $('#deleteorderForm');
                var action = '{{ route('orders.destroy', '') }}/' + orderId;
                form.attr('action', action);
                $('#confirmDeleteModal').modal('show');
            });
            $(document).on('click', '.cancel-button', function() {
                $('#confirmDeleteModal').modal('hide');
            });

            setTimeout(function () {
                $('.alert').fadeOut();
            }, 4000);
        });
    </script>
@endsection
@push('scripts')
    <script src="{{ asset('/js/tab-index.js') }}"> </script>
@endpush

@push('custom-css')
    <link rel="stylesheet" href="{{ asset('/css/tab-index.css') }}"/>
@endpush
