@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3><strong>Loan Direct Settlement Details</strong></h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right m-1">
                            <li class="breadcrumb-item">
                                <a class="btn btn-sm btn-dark" href="{{ route('memberships.show', $loan->membership->id) }}">Back</a>

                            </li>
                            <li class="breadcrumb-item">
                                <a class="btn btn-sm btn-default" href="{{ route('loan.indexSettlement') }}">Go to List</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="container-fluid">
                    <form action="{{ route('loan.updateSettlement', $loan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <h5>{{$loan->membership->ranks->rank_name}} {{$loan->membership->name}}</h5>
                                </div>
                                @if ($loan->loan->settled == 1)
                                    <div class="col-md-6 text-right">
                                        <a class="btn" href="{{ route('loan-settlement-pdf', ['id' => $loan->id, 'download' => 'pdf']) }}"><i class="fas fa-file-pdf text-red"></i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label class="col-sm-6 col-form-label">Registration No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="application_reg_no" class="form-control" value="{{ $loan->application_reg_no ?? '-'}}" readonly>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="settled" class="col-sm-6 col-form-label">settled</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="settled" class="form-control"  value="@if( $loan->loan->settled)Yes @else No @endif" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="voucher_id" class="col-sm-6 col-form-label">Voucher No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="voucher_id" class="form-control" value="{{ $loan->voucher_id ?? '-'}}" readonly>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label class="col-sm-6 col-form-label">Registered Date</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control" value="{{ $loan ? (new DateTime($loan->registered_date))->format('Y-m-d') : '' }}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="total_capital" class="col-sm-6 col-form-label">Capital Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{ number_format($loan->loan->total_capital,2) ?? '-'}}" readonly>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="total_recovered_capital" class="col-sm-6 col-form-label">Recovered Capital</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="total_recovered_capital" class="form-control" value="{{ number_format($loan->loan->total_recovered_capital,2) ?: '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="loan_due_cap" class="col-sm-6 col-form-label">Due Capital</label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="loan_due_cap" class="form-control" value="{{ ($loan->loan->total_capital - $loan->loan->total_recovered_capital) ?: '0'}}" readonly>
                                        <input type="text" class="form-control" value="{{ number_format($loan->loan->total_capital - $loan->loan->total_recovered_capital,2) ?: '-'}}" readonly>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="total_recovered_interest" class="col-sm-6 col-form-label">Recovered Interest</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{ number_format($loan->loan->total_recovered_interest,2) ?? '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="settlement_amount" class="col-sm-6 col-form-label">Settlement Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="settlement_amount" class="form-control" value="{{ $loan->directSettlement ? $loan->directSettlement->settlement_amount : 0 }}">
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="arrest_interest" class="col-sm-6 col-form-label">Arrears Interest</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="arrest_interest" class="form-control" value="{{ $loan->directSettlement ? $loan->directSettlement->arrest_interest : number_format($loan->arrest_interest,2) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="ref_no" class="col-sm-6 col-form-label">Reference No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="ref_no" class="form-control" value="{{ $loan->directSettlement ? $loan->directSettlement->ref_no : '000000' }}">
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="direct_settlement_voucher_no" class="col-sm-6 col-form-label">Settlement Voucher No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="direct_settlement_voucher_no" class="form-control" value="{{ $loan->directSettlement ? $loan->directSettlement->direct_settlement_voucher_no : 000000 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6 row">
                                    <label for="receipt_no" class="col-sm-6 col-form-label">Receipt No</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="receipt_no" class="form-control" value="{{ $loan->directSettlement ? $loan->directSettlement->receipt_no : 000000 }}">
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <label for="settlement_date" class="col-sm-6 col-form-label">Settlement Date</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="settlement_date" class="form-control" value="{{ $loan->directSettlement ? (new DateTime($loan->directSettlement->settlement_date))->format('Y-m-d') : '' }}">
                                    </div>
                                </div>
                            </div>
                            @if($loan->approved_amount!=0 && $loan->loan->settled != 1)
                                <div id="payments">
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#collapseData" id="payments">
                                                Repayment Schedule
                                                <span class="float-right"><i class="fas fa-chevron-right"></i></span>
                                            </a>
                                        </div>
                                        <div id="collapseData" class="collapse" data-parent="#payments">
                                            <div class="card-body">
                                                @if ($repaymentSchedule)
                                                    <table class="table table-bordered" id="contributionTable">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Due Date</th>
                                                            <th>Monthly Capital</th>
                                                            <th>Monthly Interest</th>
                                                            <th>To Recover</th>
                                                            <th>Installment</th>
                                                            <th>Recovered Capital</th>
                                                            <th>Recovered Interest</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($repaymentSchedule as $repayment)
                                                            <tr>
                                                                <td>{{ $repayment['installment_number'] ?? '-' }}</td>
                                                                <td>{{ $repayment['due_date'] ?? '-' }}</td>
                                                                <td>{{ number_format($repayment['monthly_capital'], 2) ?? '-' }}</td>
                                                                <td>{{ number_format($repayment['monthly_interest'], 2) ?? '-' }}</td>
                                                                <td>{{ number_format($repayment['to_recover'], 2) ?? '-' }}</td>
                                                                <td>{{ number_format($repayment['total_installment'], 2) ?? '-' }}</td>
                                                                {{--                                                    <td>{{ $repayment['payment_date'] ?? '-' }}</td>--}}
                                                                <td>{{ number_format(floatval($repayment['repayment_data']['capital_received'] ?? '-'), 2) }}</td>
                                                                <td>{{ number_format(floatval($repayment['repayment_data']['interest_received'] ?? '-'), 2) }}</td>


                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <div class="col-6 row">
                                                        <div class="col-sm-5 text-warning">
                                                            <span>No data</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                            @if ($loan->loan->settled != 1)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-4 row">
                                                <label for="fwd_to" class="col-sm-4 col-form-label">Forward To</label>
                                                <div class="col-sm-8">
                                                    @if(isset($users))
                                                        <select name="fwd_to" class="form-control" data-live-search="true" required>
                                                            <option disabled selected>Assign a Officer</option>
                                                            @foreach($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-8 row">
                                                <label for="fwd_to_reason" class="col-sm-2 col-form-label">Remark</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="fwd_to_reason" class="form-control" placeholder="Please provide a remark" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="settlement" value="forward" class="btn btn-sm btn-outline-info m-2">Forward</button>
                                            <button type="submit" name="settlement" value="send" class="btn btn-sm btn-outline-primary m-2">To Settle</button>
                                            <button type="submit" name="settlement" value="approve" class="btn btn-sm btn-outline-success m-2">Settle</button>
                                            @if ($loan->directSettlement)
                                                <button type="button" class="btn btn-sm btn-outline-danger  m-2" data-toggle="modal" data-target="#rejectModal" @if ($loan->directSettlement->reject_reason_id != null) disabled @endif>Reject</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('loan.updateSettlement', $loan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Reject Withdrawal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="fwd_to" class="col-form-label">Forward to</label>
                            <div class="col-md-12">
                                @if(isset($users))
                                    <select name="fwd_to" class="form-control" data-live-search="true">
                                        <option selected>Assign</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label for="fwd_to_reason">Reason for Rejecting</label>
                            <div class="col-md-12">
                                @if(isset($rejectReasons))
                                    <select name="fwd_to_reason" class="form-control" data-live-search="true">
                                        <option selected disabled>Reason</option>
                                        @foreach($rejectReasons as $rejectReason)
                                            <option value="{{ $rejectReason->id }}">{{ $rejectReason->reason_name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="settlement" value="reject" class="btn btn-danger">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(function () {
            $('.alert').fadeOut();
        }, 4000);
    </script>
@endsection
