<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kampung Inggris Booster | Daftar Kursus</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            max-width: 960px;
        }
    </style>
</head>

<body>

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="{{ asset('assets')}}/images/logo/Kampung-inggris-booster-logo-landscape.png" alt="Kampung Inggris Booster Logo" width="200" height="45">
                <h2>Form Pendaftaran</h2>
                <p class="lead">Silahkan isi form dibawah ini untuk pendaftaran di English Booster.</p>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible show fade">
                <ul class="ms-0 mb-0">
                    @foreach ($errors->all() as $error)
                    <li>
                        <p>{{ $error }}</p>
                    </li>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </ul>
            </div>
            @endif

            <div class="row g-5 mb-4">

                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Biodata Member</h4>
                    <form action="{{ url('/join/store') }}" method="post">
                        @csrf

                        <input type="hidden" id="affiliate" name="aff_id" value="{{$tenant->id}}">

                        <div class="row g-3">
                            <div class="col-sm-9">
                                <label for="name" class="form-label">* Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Nama Lengkap" id="name" name="name" autofocus required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-sm-3">
                                <label for="gender" class="form-label">* Jenis Kelamin</label>
                                <select class="form-select" name="gender" id="gender" required>
                                    <option value="">Pilihan</option>
                                    <option value="M">Laki - laki</option>
                                    <option value="F">Perempuan</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="phone_number" class="form-label">* No HP <sup>WA aktif untuk aktivasi dan pembayaran</sup></label>
                                <input type="number" value="{{ old('phone_number') }}" placeholder="No HP" class="form-control" id="phone_number" name="phone_number" required>
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">* Email</label>
                                <input type="email" value="{{ old('email') }}" placeholder="Email" class="form-control" id="email" name="email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">* Alamat Lengkap</label>
                                <textarea rows="5" name="address" type="text" class="form-control" id="address" placeholder="Silahkan tulis nama lengkap">{{ old('address') }}</textarea>
                            </div>
                        </div>

                </div>

                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Detail Program</span>
                    </h4>
                    <ul class="list-group mb-3">

                        <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                            <div class="text-success">
                                <h6 class="my-0">Program:</h6>
                            </div>
                            <span class="text-success">{{ $program->name }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <label for="price">Biaya Program:</label>
                            </div>
                            <span class="text-body-secondary">Rp. {{ number_format($program->price) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <select name="period_id" id="period_id" class="form-control" required>
                                <option value="">Pilihan Periode</option>
                                @foreach ($program->periods as $period)
                                <option value="{{ $period->id }}">{{ $period->period_date }}</option>
                                @endforeach
                            </select>
                        </li>
                        @php
                        $admin_fee = 0;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <label for="admin-fee">Biaya Admin:</label>
                            </div>
                            <span class="text-body-secondary">Rp. {{ number_format($admin_fee) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <h6 class="my-0">Subtotal:</h6>
                            <strong>Rp. {{ number_format($program->price + $admin_fee) }}</strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <h6 class="my-0">Diskon:</h6>
                            <strong class="discountAmount">Rp. 0</strong>
                        </li>
                        <input type="hidden" class="couponId" name="coupon_id">
                    </ul>

                    <div class="card p-2 mb-4">
                        <div class="input-group">
                            <input type="hidden" class="form-control program_id" value="{{ $program->id }}" name="program_id">
                            <input type="text" class="form-control coupon_code" name="coupon_code" placeholder="Promo code">
                            <button class="btn btn-secondary apply_coupon_btn">Redeem</button>
                        </div>
                    </div>
                    <small id="error_coupon" class="text-danger mb-3"></small>
                    <small id="coupon_response" class="text-danger mb-3"></small>

                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required />
                <label class="form-check-label" for="flexCheckDefault">Saya setuju dengan <a href="#exampleModal" data-bs-toggle="modal">syarat ketentuan</a> berlaku</label>
            </div>
            <button class="w-100 btn btn-primary btn-lg" type="submit">Kirim Data</button>
            <br />
            <br />
            <br />
            </form>
        </main>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Syarat dan Ketentuan Pendaftaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.apply_coupon_btn').click(function(e) {
            e.preventDefault();

            var program_id = $('.program_id').val();
            var coupon_code = $('.coupon_code').val();

            if ($.trim(coupon_code).length == 0) {
                error_coupon = 'Masukkan kupon yang valid';
                $('#error_coupon').text(error_coupon);
            } else {
                error_coupon = '';
                $('#error_coupon').text(error_coupon);
            }

            if (error_coupon != '') {
                return false;
            }

            $.ajax({

                method: "POST",
                url: "/check-coupon-code",
                data: {
                    'coupon_code': coupon_code,
                    'program_id': program_id
                },
                success: function(response) {
                    if (response.status == 'error') {
                        coupon_response = 'Kupon tidak tersedia!';
                        $('.coupon_code').val('');
                        $('#coupon_response').text(response.message);
                    } else {
                        var discountAmount = response.discountAmount;
                        $('.couponId').val(response.couponId)
                        $('.discountAmount').text(discountAmount)
                        $('#coupon_response').text(response.message);
                    }
                }
            });
        });
    </script>
</body>

</html>