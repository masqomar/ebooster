<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kampung Inggris Booster | Tempat terbaik untuk belajar bahasa Inggris</title>
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
    <div class="blogarea__2 sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="course__details__sidebar">
                        <div class="event__sidebar__wraper" data-aos="fade-up">
                            <img class="d-block mx-auto mb-4" src="{{ asset('assets')}}/images/logo/Kampung-inggris-booster-logo-landscape.png" alt="Kampung Inggris Booster Logo" width="200" height="45">
                            <h3 class="text-center">Detail Pendaftaran</h3>
                            <hr />

                            <div class="course__summery__lists">
                                <ul>
                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Nama:</span><span class="sb_content"><a href="">{{ $transaction->user->name }}</a></span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Email</span><span class="sb_content">{{ $transaction->user->email }}</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">No HP</span><span class="sb_content">{{ $transaction->user->student->phone_number }}</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Jenis Kelamin</span><span class="sb_content">{{ $transaction->user->student->gender == 'M' ? 'Laki-laki' : 'Perempuan' }}</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Alamat</span><span class="sb_content">{{ $transaction->user->student->address }}</span>
                                        </div>
                                    </li>

                                    <hr />

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Program</span><span class="sb_content">{{ $transaction->program->name }}</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Periode</span><span class="sb_content">{{ $transaction->period }}</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Biaya Program</span><span class="sb_content">Rp. {{ number_format($transaction->program->price) }}</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Biaya Admin</span><span class="sb_content">Rp. {{ number_format($transaction->admin_fee ? $transaction->admin_fee : 0) }}</span>
                                        </div>
                                    </li>
                                    <hr />

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label"><strong>Subtotal</strong></span><span class="sb_content"><strong>Rp. {{ number_format($transaction->admin_fee + $transaction->program->price) }}</strong></span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label"><strong>Diskon</strong></span><span class="sb_content"><strong>Rp. {{ number_format($transaction->discount ? $transaction->discount : 0) }}</strong></span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label"><strong>Down Payment</strong></span><span class="sb_content"><strong>Rp. {{ number_format($transaction->down_payment) }}</strong></span>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="course__summery__button">
                                @if ($transaction->transaction_status == 'pending')
                                <button class="default__button" id="pay-button">Bayar DP Sekarang</button>
                                @elseif ($transaction->transaction_status == 'failed')
                                <button class="default__button default__button--2" href="#">Pembayaran Gagal!</button>
                                @else
                                <button class="default__button default__button--3" href="#">Pembayaran Terverifikasi!</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{$transaction->snap_token}}', {
                onSuccess: function(result) {
                    window.location.href = '{{ url("payment-success/".$transaction->id."/down-payment") }}';
                },
                onPending: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onError: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>

</body>

</html>