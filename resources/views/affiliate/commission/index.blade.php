@extends('layouts.app')
@section('title', __('Kampung Inggris Booster Affiliate Form'))
@section('content')

<div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="/dashboard" class="text-gray-200 fw-normal text-15 hover-text-main-600">Dashboard</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">Commissions</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
    <!-- Breadcrumb Right Start -->
    <div class="flex-align gap-8 flex-wrap">
        <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
            <span class="text-lg"><i class="ph ph-layout"></i></span>
            <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center" id="exportOptions">
                <option value="" selected disabled>Export</option>
                <option value="csv">CSV</option>
                <option value="json">JSON</option>
            </select>
        </div>
    </div>
    <!-- Breadcrumb Right End -->

</div>


<div class="card overflow-hidden mb-20">
    <div class="card-body p-0">
        <h4 class="text-center mb-20">Data Lead & Komisi</h4>
        @if(count($commissions) > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tagihan</th>
                        <th>Discount</th>
                        <th>DP</th>
                        <th>Status Bayar</th>
                        <th>Pelunasan</th>
                        <th>Komisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commissions as $transaction)
                    <tr>
                        <td>{{ $transaction->user->name }}</td>
                        <td>Rp. {{ number_format($transaction['total_purchases']) }}</td>
                        <td>Rp. {{ number_format($transaction['discount'] ?? 0) }}</td>
                        <td>Rp. {{ number_format($transaction['down_payment'] ?? 0) }}</td>
                        <td><span class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">{{ ucfirst($transaction['transaction_status']) }}</span></td>
                        <td>
                            @if(count($transaction['transaction_details']) > 0)
                            <ul>
                                @foreach($transaction['transaction_details'] as $detail)
                                <li>
                                    Nominal: Rp. {{ number_format($detail['full_payment']) }} <br>
                                    Status: {{ ucfirst($detail['payment_status']) }}
                                </li>
                                @endforeach
                            </ul>
                            @else
                            No details available
                            @endif
                        </td>
                        @if ($transaction->down_payment == NULL)

                        @if ($transaction->transaction_status == 'paid')
                        <td>Rp. {{ number_format($transaction['total_purchases'] * 0.1) }}</td>
                        @else
                        <td>Rp. 0</td>
                        @endif

                        @else
                        @if ($detail->payment_status == 'paid')
                        <td>Rp. {{ number_format(($transaction['down_payment'] + $detail['full_payment']) * 0.1) }}</td>
                        @else
                        <td>Rp. 0</td>
                        @endif
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No transactions found.</p>
            @endif
        </div>
    </div>
    <div class="card-footer flex-between flex-wrap">
        <span class="text-gray-900">Showing 1 to 10 of 12 entries</span>
        <ul class="pagination flex-align flex-wrap">
            <li class="page-item active">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">...</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">8</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">9</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">10</a>
            </li>
        </ul>
    </div>
</div>


<div class="card overflow-hidden mb-8">
    <div class="card-body p-0">
        <h4 class="text-center mb-20">Data Kunjungan Link & Komisi</h4>
        <div class="table-responsive">
        <table id="visitTable" class="table table-bordered">
            <thead>
                <tr>
                    <th class="h6 text-gray-300">No</th>
                    <th class="h6 text-gray-300">IP</th>
                    <th class="h6 text-gray-300">Tanggal</th>
                    <th class="h6 text-gray-300">Komisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($affId['visits'] as $visit)
                <tr>
                    <td>
                        <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                    </td>
                    <td>
                        <span
                            class="text-13 py-2 px-8 bg-teal-50 text-teal-600 d-inline-flex align-items-center gap-8 rounded-pill">
                            <span class="w-6 h-6 bg-teal-600 rounded-circle flex-shrink-0"></span>
                            {{ $visit['data']['ip'] }}
                        </span>
                    </td>
                    <td> <span class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">{{ $visit['created_at']->format('d-m-Y H:i') }}</span></td>
                <td>Rp. 1</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer flex-between flex-wrap">
        <span class="text-gray-900">Showing 1 to 10 of 12 entries</span>
        <ul class="pagination flex-align flex-wrap">
            <li class="page-item active">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">...</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">8</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">9</a>
            </li>
            <li class="page-item">
                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">10</a>
            </li>
        </ul>
    </div>
</div>


@endsection