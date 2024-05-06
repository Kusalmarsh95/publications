@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-print text-orange"></i> <strong>Publication Management</strong> | Orders
                            Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Publication Management</strong> > <i class="nav-icon fas fa-users text-orange"></i> Create Orders</h6>
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
                                    <label for="customer_id" class="col-sm-2 col-form-label">Customer</label>
                                    <div class="col-sm-8">
                                        @if(isset($customers))
                                            <select name="customer_id" class="form-control" data-live-search="true">
                                                <option selected>Select Customer</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-sm-1 text-right">
                                        <a href="{{ route('customers.create') }}" class="btn btn-sm btn-warning"><i class="nav-icon fas fa-user-plus"></i></a>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="date" class="col-sm-4 col-form-label">Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="order_no" class="col-sm-4 col-form-label">Order No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="order_no" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="hr">
                            <div class="row" >
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <strong>Service</strong>
                                        <select class="form-control service_id" data-live-search="true" name="service_id[]" required>
                                            <option value="" disabled selected>Select service</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
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
                            <select class="form-control service_id" data-live-search="true" name="service_id[]" required>
                                <option value="" disabled selected>Select service</option>
                                @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
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

            // Event listener for service selection change
            $('#hr').on('change', '.service_id', function () {
                var unitPrice = $(this).find(':selected').data('unit-price');
                $(this).closest('.row').find('.unit_price').val(unitPrice);
            });

            var servicePrices = {
                @foreach($services as $service)
                '{{ $service->id }}': '{{ $service->unit_price  }}',
                @endforeach
            };

            $('#hr').on('change', '.service_id', function () {
                var selectedserviceId = $(this).val();
                var unitPriceInput = $(this).closest('.row').find('.unit_price');
                if (servicePrices.hasOwnProperty(selectedserviceId)) {
                    // Format the unit price as number with two decimal places and comma separators
                    var formattedPrice = parseFloat(servicePrices[selectedserviceId]).toLocaleString('en-US', {
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
