
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pembayaran Pelunasan Sukses | Kampung Inggris Booster</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('template') }}/front/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/front/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/front/css/aos.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/front/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('template') }}/front/css/icofont.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/front/css/slick.css">
    <link rel="stylesheet" href="{{ asset('template') }}/front/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/front/css/style.css">

</head>

<body class="body__wrapper">
<section class="py-3 py-md-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
                <div class="row gy-3 mb-3">
                    <div class="col-9">
                        <h6 class="text-uppercase text-endx m-0">Invoice #{{ $transactionDetails->transaction->code }}</h6>
                    </div>
                    <div class="col-3">
                        <a class="d-block text-end" href="#!">
                            <img src="{{ asset('assets')}}/images/logo/Kampung-inggris-booster-logo-landscape.png" class="img-fluid" alt="English Booster Logo" width="135" height="44">
                        </a>
                    </div>
                    <div class="col-12">
                        <h4>From</h4>
                        <address>
                            <strong>English Booster</strong><br>
                            Kampung Inggris<br>
                            Jl. Asparaga No. 83, Tegalsari<br>
                            Tulungrejo, Pare, Kediri<br>
                            Phone: 0822 3105 0500<br>
                            Email: kampunginggrisbooster@gmail.com
                        </address>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-sm-6 col-md-8">
                        <h4>Bill To</h4>
                        <address>
                            <strong>{{ $transactionDetails->transaction->user->name }}</strong><br>
                            {{ $transactionDetails->transaction->user->student->address }}<br>
                            Phone: {{ $transactionDetails->transaction->user->student->phone_number }}<br>
                            Email: {{ $transactionDetails->transaction->user->email }}
                        </address>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <h4 class="row">
                            <span class="col-6">Reff</span>
                            <span class="col-6 text-sm-end">#{{ $transactionDetails->transaction->invoice }}</span>
                        </h4>
                        <div class="row">
                            <span class="col-6">Date</span>
                            <span class="col-6 text-sm-end">{{ $transactionDetails->transaction->updated_at->format('d-m-y') }}</span>
                            <span class="col-6">Status</span>
                            @if ($transactionDetails->payment_status == 'pending')
                            <span class="col-6 text-sm-end bg-info text-white">{{ $transactionDetails->payment_status }}</span>
                            @elseif ($transactionDetails->payment_status == 'paid')                            
                            <span class="col-6 text-sm-end bg-succes text-black">{{ $transactionDetails->payment_status }}</span>
                            @elseif ($transactionDetails->payment_status == 'failed')                            
                            <span class="col-6 text-sm-end bg-danger text-black">{{ $transactionDetails->payment_status }}</span>
                            @else
                            <span class="col-6 text-sm-end bg-warning text-black">{{ $transactionDetails->payment_status }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-uppercase">Deskripsi</th>
                                        <th scope="col" class="text-uppercase text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>Pelunasan Program {{ $transactionDetails->transaction->program->name }}</td>
                                        <td class="text-end">Rp. {{ number_format($transactionDetails->full_payment) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-uppercase text-end">Total</th>
                                        <td class="text-end">Rp. {{ number_format($transactionDetails->full_payment) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary mb-3">Download Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- JS here -->
 <script src="{{ asset('template') }}/front/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="{{ asset('template') }}/front/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('template') }}/front/js/popper.min.js"></script>
    <script src="{{ asset('template') }}/front/js/bootstrap.min.js"></script>
    <script src="{{ asset('template') }}/front/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('template') }}/front/js/slick.min.js"></script>
    <script src="{{ asset('template') }}/front/js/jquery.meanmenu.min.js"></script>
    <script src="{{ asset('template') }}/front/js/ajax-form.js"></script>
    <script src="{{ asset('template') }}/front/js/wow.min.js"></script>
    <script src="{{ asset('template') }}/front/js/jquery.scrollUp.min.js"></script>
    <script src="{{ asset('template') }}/front/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('template') }}/front/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('template') }}/front/js/waypoints.min.js"></script>
    <script src="{{ asset('template') }}/front/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('template') }}/front/js/plugins.js"></script>
    <script src="{{ asset('template') }}/front/js/swiper-bundle.min.js"></script>
    <script src="{{ asset('template') }}/front/js/main.js"></script>
</body>

</html>