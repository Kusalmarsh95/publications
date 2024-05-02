@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-address-card text-blue"></i> <strong>Master Data</strong> | Services Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Master Data</strong> > <i class="nav-icon fas fa-pen text-blue"></i> Services
                            Management</h6>
                    </div>
                </div>
                <div class="row mb-2">
{{--                    @can('master-data-services-create')--}}
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-sm bg-blue" href="{{ route('services.create') }}"><i class="nav-icon fas fa-pen"></i> Create Service</a>
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

    <div class="card m-1">
        <div class="card-body">
            <table class="table table-bordered " id="servicesTable">
                <thead>
                <tr class="text-center">
                    <th style="width: 20px">No</th>
                    <th>Service Name</th>
                    <th>Service code</th>
                    <th>Category</th>
                    <th>Unit Price</th>
                    <th class="text-center" style="width: 120px">Action</th>
                </tr>
                </thead>
                @php
                    $i=0;
                @endphp
                <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $service->name ?? '-' }}</td>
                        <td>{{ $service->code ?? '-' }}</td>
                        <td>{{ $service->serviceCategory->name ?? '-' }}</td>
                        <td>Rs. {{ number_format($service->unit_price, 2) ?? '-' }}</td>
                        <td class="text-center">
                            <a class="btn" href="{{ route('services.edit', $service->id) }}">
                                <i class="fas fa-pen" style="color: lightseagreen;"></i>
                            </a>
                            <button class="btn delete-button" data-id="{{ $service->id }}">
                                <i class="fas fa-trash-alt" style="color: red;"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                    <form id="deleteserviceForm" method="POST" action="">
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
            $('#servicesTable').DataTable({
                responsive: true,
                buttons: []
            });

            $(document).on('click', '.delete-button', function () {
                var serviceId = $(this).data('id');
                var form = $('#deleteserviceForm');
                var action = '{{ route('services.destroy', '') }}/' + serviceId;
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
