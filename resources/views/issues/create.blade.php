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
                        <h6> <strong>Stock Management</strong> > <i class="nav-icon fas fa-shopping-bag text-yellow"></i> Create Issues</h6>
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
                    <form action="{{ route('issues.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="worker_id" class="col-sm-2 col-form-label">Worker</label>
                                    <div class="col-sm-8">
                                        @if(isset($workers))
                                            <select name="worker_id" class="form-control" data-live-search="true">
                                                <option selected>Select Worker</option>
                                                @foreach($workers as $worker)
                                                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-sm-1 text-right">
                                        <a href="{{ route('workers.create') }}" class="btn btn-sm btn-warning"><i class="nav-icon fas fa-user-plus"></i></a>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="date" class="col-sm-4 col-form-label">Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="issue_no" class="col-sm-4 col-form-label">Issue No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="issue_no" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="hr">
                            <div class="row" >
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <strong>Item</strong>
                                        <select class="form-control item_id" data-live-search="true" name="item_id[]" required>
                                            <option value="" disabled selected>Select Item</option>
                                            @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <strong>Quantity</strong>
                                        <input type="text" class="form-control quantity" name="quantity[]" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <strong>Unit Price (LKR)</strong>
                                        <input type="text" class="form-control unit_price" name="unit_price[]" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <strong>Total (LKR)</strong>
                                        <input type="text" class="form-control total" name="total[]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-success mt-2" id="addCategory">Add New &nbsp</button>
                        </div>
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-md-8">
                                    <div class="form-group text-right">
                                        <strong>Total Items</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control total_items" name="total_items" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var categoryCounter = 1;

            // Function to add a new category row
            function addCategoryRow() {
                var newRow = `
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select class="form-control item_id" data-live-search="true" name="item_id[]" required>
                                <option value="" disabled selected>Select Item</option>
                                @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <input type="text" class="form-control quantity" name="quantity[]" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" class="form-control unit_price" name="unit_price[]" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" class="form-control total" name="total[]" required>
            </div>
        </div>
        <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="fas fa-trash-alt"></i></button>
                    </div>
    </div>

`;
                $('#hr').append(newRow);
            }

            $('#addCategory').click(function (e) {
                e.preventDefault();
                addCategoryRow();
            });

            $('#hr').on('click', '.remove-row', function () {
                $(this).closest('.row').remove();
                updatetotalItems();
            });

            $('#hr').on('change', '.item_id', function () {
                var unitPrice = $(this).find(':selected').data('unit-price');
                $(this).closest('.row').find('.unit_price').val(unitPrice);
            });

            var itemPrices = {
                @foreach($items as $item)
                '{{ $item->id }}': '{{ $item->buying_price  }}',
                @endforeach
            };

            $('#hr').on('change', '.item_id', function () {
                var selectedItemId = $(this).val();
                var unitPriceInput = $(this).closest('.row').find('.unit_price');
                if (itemPrices.hasOwnProperty(selectedItemId)) {
                    var formattedPrice = parseFloat(itemPrices[selectedItemId]).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    unitPriceInput.val(formattedPrice);
                } else {
                    unitPriceInput.val('');
                }
            });

            $('#hr').on('input', '.quantity', function () {
                updateTotal($(this).closest('.row'));
                updatetotalItems();
            });

            function updateTotal(row) {
                var quantity = parseFloat(row.find('.quantity').val()) || 0;
                var unitPrice = parseFloat(row.find('.unit_price').val().replace(/,/g, '')) || 0; // Remove commas before parsing
                var total = quantity * unitPrice;
                var totalInput = row.find('.total');
                totalInput.val(total.toLocaleString('en-US', { minimumFractionDigits: 2 }));
            }

            function updatetotalItems() {
                var totalItems = 0;
                $('input[name="quantity[]"]').each(function () {
                    var total = parseFloat($(this).val().replace(/,/g, '')) || 0;
                    totalItems = total + totalItems;
                });

                $('input[name="total_items"]').val(totalItems);
            }

            updatetotalItems();

            setTimeout(function () {
                $('.alert').fadeOut();
            }, 4000);
        });
    </script>

@endsection
