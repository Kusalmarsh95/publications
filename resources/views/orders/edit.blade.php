@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-Left">
                        <h4><i class="nav-icon fas fa-store text-yellow"></i> <strong>Stock Management</strong> | Orders Management</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h6> <strong>Stock Management</strong> > <i class="nav-icon fas fa-shopping-bag text-yellow"></i> Edit Order</h6>
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
                    <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="customer_id" class="col-sm-3 col-form-label">Customer</label>
                                    <div class="col-sm-9">
                                        @if(isset($customers))
                                            <select name="customer_id" class="form-control" data-live-search="true">
                                                <option disabled>Select Customer</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ $customer->id == $order->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="date" class="col-sm-4 col-form-label">Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="date" class="form-control" value="{{ $order->date }}" required>
                                    </div>
                                </div>
                                <div class="col-3 row">
                                    <label for="order_no" class="col-sm-4 col-form-label">Order No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="order_no" class="form-control" value="{{ $order->order_no }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="files" class="col-form-label">Upload New File</label>
                                    <input type="file" name="files" class="form-control-file">
                                    @if ($order->files)
                                        <p>Current File: <a href="{{ asset('storage/' . $order->files) }}" target="_blank"><i class="fas fa-file-export"></i></a></p>
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
                        <div class="card-body" id="hr">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <strong>Service</strong>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <strong>Quantity</strong>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <strong>Unit Price (LKR)</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <strong>Total (LKR)</strong>
                                    </div>
                                </div>
                            </div>
                            @foreach($order->details as $detail)
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <select class="form-control service_id" data-live-search="true" name="service_id[]" required>
                                                <option disabled>Select Service</option>
                                                @foreach($services as $service)
                                                    <option value="{{ $service->id }}" {{ $service->id == $detail->service_id ? 'selected' : '' }}>{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control quantity" name="quantity[]" value="{{ $detail->quantity }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control unit_price" name="unit_price[]" value="{{ $detail->unit_price }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control total" name="total[]" value="{{ $detail->total }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-success mt-2" id="addCategory">Add New &nbsp</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group text-right">
                                        <strong>Total Amount (LKR)</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control total_amount" name="total_amount" value="{{ $order->total_amount }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group text-right">
                                        <strong>Discount (%)</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control discount" name="discount" value="{{ $order->discount }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group text-right">
                                        <strong>Net Amount (LKR)</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control net_amount" name="net_amount" value="{{ $order->net_amount }}" required>
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
                                <option disabled>Select Service</option>
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

            $('#hr').on('input', '.quantity, .unit_price', function () {
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
