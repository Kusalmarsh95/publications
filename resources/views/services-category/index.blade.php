@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-address-card text-blue"></i> <strong>Master Data</strong> | Service Category Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Master Data</strong> > <i class="nav-icon fas fa-place-of-worship text-blue"></i> Service Categories
                            Management</h6>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12 text-right">
                        <a class="btn btn-sm bg-blue" href="{{ route('services-category.create') }}"><i class="nav-icon fas fa-place-of-worship"></i> Create Service Category</a>
                    </div>

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
            <table class="table table-bordered" id="services-category">
                <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Service Category</th>
                    <th>Remarks</th>
                    <th class="text-center" width="120px">Action</th>
                </tr>
                </thead>
                @php
                    $i=0;
                @endphp
                <tbody>
                @foreach ($serviceCategories as $servicescategory)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $servicescategory->name ? : '-' }}</td>
                        <td>{{ $servicescategory->remark ? : '-' }}</td>
                        <td class="text-center">
                            <a class="btn" href="{{ route('services-category.edit',$servicescategory->id) }}" title="Edit"><i class="fas fa-pen" style="color: lightseagreen;"></i></a>
                            <button class="btn delete-button" data-id="{{ $servicescategory->id }}" title="Delete">
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
                    <form id="deleteserviceCatForm" method="POST" action="">
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
            $('#services-category').DataTable({
                responsive: true
            });

            $(document).on('click', '.delete-button', function () {
                var categoryId = $(this).data('id');
                var form = $('#deleteserviceCatForm');
                var action = '{{ route('services-category.destroy', '') }}/' + categoryId;
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

