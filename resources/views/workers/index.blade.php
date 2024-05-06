@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-store text-yellow"></i> <strong>Stock Management</strong> | Workers Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Stock Management</strong> > <i class="nav-icon fas fa-users text-yellow"></i> Workers
                            Management</h6>
                    </div>
                </div>
                <div class="row mb-2">
{{--                    @can('master-data-workers-create')--}}
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-sm bg-yellow" href="{{ route('workers.create') }}"><i class="nav-icon fas fa-users"></i> Create Worker</a>
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
            <table class="table table-bordered " id="workersTable">
                <thead>
                <tr class="text-center">
                    <th style="width: 20px">No</th>
                    <th>Service No</th>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Regiment</th>
                    <th class="text-center" style="width: 120px">Action</th>
                </tr>
                </thead>
                @php
                    $i=0;
                @endphp
                <tbody>
                @foreach ($workers as $worker)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $worker->service_no ?? '-' }}</td>
                        <td>{{ $worker->rank ?? '-' }}</td>
                        <td>{{ $worker->name ?? '-' }}</td>
                        <td>{{ $worker->regiment ?? '-' }}</td>
                        <td class="text-center">
                            <a class="btn" href="{{ route('workers.edit', $worker->id) }}">
                                <i class="fas fa-pen" style="color: lightseagreen;"></i>
                            </a>
                            <button class="btn delete-button" data-id="{{ $worker->id }}">
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
                    <form id="deleteworkerForm" method="POST" action="">
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
            $('#workersTable').DataTable({
                responsive: true,
                buttons: []
            });

            $(document).on('click', '.delete-button', function () {
                var workerId = $(this).data('id');
                var form = $('#deleteworkerForm');
                var action = '{{ route('workers.destroy', '') }}/' + workerId;
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
