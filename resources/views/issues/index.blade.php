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
                        <h6> <strong>Stock Management</strong> > <i class="nav-icon fas fa-shopping-bag text-yellow"></i> Issues
                            Management</h6>
                    </div>
                </div>
                <div class="row mb-2">
{{--                    @can('master-data-issues-create')--}}
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-sm bg-yellow" href="{{ route('issues.create') }}"><i class="nav-icon fas fa-shopping-bag"></i> Create Issue</a>
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
            <table class="table table-bordered " id="issuesTable">
                <thead>
                <tr class="text-center">
                    <th style="width: 20px">No</th>
                    <th>Issue No</th>
                    <th>Worker</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 120px">Action</th>
                </tr>
                </thead>
                @php
                    $i=0;
                @endphp
                <tbody>
                @foreach ($issues as $issue)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $issue->issue_no ?? '-' }}</td>
                        <td>{{ $issue->worker->name ?? '-' }}</td>
                        <td>{{ $issue->date ?? '-' }}</td>
                        <td>
                            @if($issue->status === 0)
                                <label class="badge badge-success">Approved</label>
                            @elseif($issue->status === 1)
                                <label class="badge badge-warning">Pending</label>
                            @elseif($issue->status === 2)
                                <label class="badge badge-danger">Rejected</label>
                            @else
                                -
                            @endif
                        </td>

                        <td class="text-center">
                            <a class="btn" href="{{ route('issues.show', $issue->id) }}">
                                <i class="fas fa-eye" style="color: rosybrown;"></i>
                            </a>
                            <a class="btn" href="{{ route('issues.edit', $issue->id) }}">
                                <i class="fas fa-pen" style="color: lightseagreen;"></i>
                            </a>
                            <button class="btn delete-button" data-id="{{ $issue->id }}">
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
                    <form id="deleteissueForm" method="POST" action="">
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
            $('#issuesTable').DataTable({
                responsive: true,
                buttons: []
            });

            $(document).on('click', '.delete-button', function () {
                var issueId = $(this).data('id');
                var form = $('#deleteissueForm');
                var action = '{{ route('issues.destroy', '') }}/' + issueId;
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
