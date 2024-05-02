@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 text-center">
                        <h2><strong>Direct Settlement</strong></h2>
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
    <div class="card">
        <div class="card-header">
            <button class="tab-link" onclick="openPage('Processing', this, '#3e7d2c')" id="defaultOpen">Processing</button>
            <button class="tab-link" onclick="openPage('Rejected', this, '#3e7d2c')">Rejected</button>
            <div id="Processing" class="tab-content">
                <table class="table table-bordered" id="newSettlement">
                    <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Application No</th>
                        <th>Name</th>
                        <th>Total Capital</th>
                        <th>Recovered Capital</th>
                        <th style="width: 80px">Action</th>
                    </tr>
                    </thead>
                    @php
                        $i=0;
                    @endphp
                    <tbody>
                    @foreach ($loans as $loan)
                        @if($loan->directSettlement->reject_reason_id == null)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $loan->application_reg_no ?? '-' }}</td>
                                <td>{{ $loan->membership->ranks->rank_name ?? '-'}} {{ $loan->membership->name ?? '-'}}</td>
                                <td>{{ number_format($loan->loan->total_capital,2) ?? '-' }}</td>
                                <td>{{ number_format($loan->loan->total_recovered_capital,2) ?? '-' }}</td>
                                <td class="text-center">
                                    @can('loans-direct-settlement-approve')
                                        <a class="btn" href="{{ route('loan.editSettlement',$loan->id) }}"><i class="fas fa-user-check" style="color: lightseagreen;"></i></a>
                                    @endcan                                        
                                        </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="Rejected" class="tab-content">
                <table class="table table-bordered" id="rejectSettlement">
                    <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Application No</th>
                        <th>Name</th>
                        <th>Total Capital</th>
                        <th>Recovered Capital</th>
                        <th style="width: 50px">Action</th>
                    </tr>
                    </thead>
                    @php
                        $i=0;
                    @endphp
                    <tbody>
                    @foreach ($loans as $loan)
                        @if($loan->directSettlement->reject_reason_id != null)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $loan->application_reg_no ?? '-' }}</td>
                                <td>{{ $loan->membership->ranks->rank_name ?? '-'}} {{ $loan->membership->name ?? '-'}}</td>
                                <td>{{ number_format($loan->loan->total_capital,2) ?? '-' }}</td>
                                <td>{{ number_format($loan->loan->total_recovered_capital,2) ?? '-' }}</td>
                                <td class="text-center">
                                    @can('loans-direct-settlement-approve')
                                        <a class="btn" href="{{ route('loan.editSettlement',$loan->id) }}"><i class="fas fa-user-check" style="color: lightseagreen;"></i></a>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#newSettlement').DataTable({
                responsive: true,
                // paging: false,
                // info: false,
                buttons: [
                ]
            });
            $('#rejectSettlement').DataTable({
                responsive: true,
                // paging: false,
                // info: false,
                buttons: [
                ]
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
