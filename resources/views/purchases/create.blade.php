@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-store text-yellow"></i> <strong>Stock Management</strong> | Purchases Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Stock Management</strong> > <i class="nav-icon fas fa-shopping-bag text-yellow"></i> Create Purchases</h6>
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
                    <form action="{{ route('purchases.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="supplier_id" class="col-sm-2 col-form-label">Supplier</label>
                                    <div class="col-sm-8">
                                        @if(isset($suppliers))
                                            <select name="supplier_id" class="form-control" data-live-search="true">
                                                <option selected>Select Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-sm-1 text-right">
                                        <a href="{{ route('suppliers.create') }}" class="btn btn-sm btn-warning"><i class="nav-icon fas fa-user-plus"></i></a>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="date" class="col-sm-4 col-form-label">Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="purchase_no" class="col-sm-4 col-form-label">Bill No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="purchase_no" class="form-control" required>
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
                                        <strong>Total Amonut(LKR)</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control total_amount" name="total_amount" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-8">
                                    <div class="form-group text-right">
                                        <strong>Discount (%)</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control discount" value="0" name="discount" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-8">
                                    <div class="form-group text-right">
                                        <strong>Net Amount (LKR)</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control net_amount" name="net_amount" required>
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

            // Event listener for "Add New" button click
            $('#addCategory').click(function (e) {
                e.preventDefault(); // Prevent the default form submission
                addCategoryRow(); // Add a new category row
            });

            $('#hr').on('click', '.remove-row', function () {
                $(this).closest('.row').remove();
                updateTotalAmount();
                updateNetAmount();
            });

            // Event listener for item selection change
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
                    // Format the unit price as number with two decimal places and comma separators
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
                updateTotalAmount();
                updateNetAmount();
            });

            function updateTotal(row) {
                var quantity = parseFloat(row.find('.quantity').val()) || 0;
                var unitPrice = parseFloat(row.find('.unit_price').val().replace(/,/g, '')) || 0; // Remove commas before parsing
                var total = quantity * unitPrice;
                var totalInput = row.find('.total');
                totalInput.val(total.toLocaleString('en-US', { minimumFractionDigits: 2 }));
            }

            function updateTotalAmount() {
                var totalAmount = 0;
                $('input[name="total[]"]').each(function () {
                    var total = parseFloat($(this).val().replace(/,/g, '')) || 0;
                    totalAmount = total + totalAmount;
                });

                $('input[name="total_amount"]').val(totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2 }));
            }

            $('input[name="discount"]').on('input', function () {
                updateNetAmount();
            });
            function updateNetAmount() {
                var totalAmount = parseFloat($('input[name="total_amount"]').val().replace(/,/g, '')) || 0; // Remove commas before parsing
                var discount = parseFloat($('input[name="discount"]').val()) || 0;
                var netAmount = totalAmount - (totalAmount * discount / 100);
                $('input[name="net_amount"]').val(netAmount.toLocaleString('en-US', { minimumFractionDigits: 2 }));
            }

            updateTotalAmount();
            updateNetAmount();

            setTimeout(function () {
                $('.alert').fadeOut();
            }, 4000);
        });
    </script>

@endsection
