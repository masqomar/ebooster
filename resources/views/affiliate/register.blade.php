@extends('layouts.app')
@section('title', __('Kampung Inggris Booster Affiliate Form'))
@section('content')
<div class="card">
    <div class="card-header border-bottom border-gray-100 flex-align gap-8">
        <h5 class="mb-0">Form Pembuatan Link Affiliate</h5>
        <button type="button" class="text-main-600 text-md d-flex" data-bs-toggle="tooltip"
            data-bs-placement="top" data-bs-title="Form Pembuatan Link Affiliate">
            <i class="ph-fill ph-question"></i>
        </button>
    </div>

    <div class="card-body">

        <form action="{{ route('affiliate.register.store') }}" method="post">
            @csrf

            <div class="row g-20">
                <div class="col-xl-6 col-md-4 col-sm-6">
                    <div class="mb-24">
                        <label for="subdomain" class="form-label mb-8 h6"> Link Affiliate</label>
                        <div class="position-relative">
                            <div class="input-group mb-1">
                                <input type="text" value="{{ old('subdomain') }}" class="form-control py-11 ps-40 @error('subdomain') is-invalid @enderror" name="subdomain" placeholder="Soni" required>
                                <span class="input-group-text">@englishboosterofficial.com</span>
                            </div>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-globe"></i></span>
                        </div>
                        @error('subdomain')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-24">
                        <label for="phone_number" class="form-label mb-8 h6">Nomor WA</label>
                        <div class="position-relative">
                            <div class="input-group mb-1">
                                <input type="number" value="{{ old('phone_number') }}" class="form-control py-11 ps-40 @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="11223344" required>
                            </div>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-whatsapp-logo"></i></span>
                        </div>
                        @error('phone_number')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-24">
                        <label for="address" class="form-label mb-8 h6"> Alamat Lengkap</label>
                        <div class="position-relative">
                            <textarea type="text" name="address" rows="5" value="{{ old('address') }}" class="form-control py-11 ps-40 @error('address') is-invalid @enderror" id="address" placeholder="Alamat Lengkap"></textarea>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-address-book"></i></span>
                        </div>
                        @error('address')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-6 col-md-4 col-sm-6">
                    <div class="mb-24">
                        <label for="account_bank" class="form-label mb-8 h6">Bank</label>
                        <div class="position-relative">
                            <div class="input-group mb-1">
                                <input type="text" value="{{ old('account_bank') }}" class="form-control py-11 ps-40 @error('account_bank') is-invalid @enderror" name="account_bank" placeholder="BRI" required>
                            </div>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-bank"></i></span>
                        </div>
                        @error('account_bank')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-24">
                        <label for="account_number" class="form-label mb-8 h6">Nomor Rekening</label>
                        <div class="position-relative">
                            <div class="input-group mb-1">
                                <input type="text" value="{{ old('account_number') }}" class="form-control py-11 ps-40 @error('account_number') is-invalid @enderror" name="account_number" placeholder="11223344" required>
                            </div>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-piggy-bank"></i></span>
                        </div>
                        @error('account_number')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-24">
                        <label for="account_name" class="form-label mb-8 h6">Rekening Atas Nama</label>
                        <div class="position-relative">
                            <div class="input-group mb-1">
                                <input type="text" value="{{ old('account_name') }}" class="form-control py-11 ps-40 @error('account_name') is-invalid @enderror" name="account_name" placeholder="Sofa Mania" required>
                            </div>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-identification-card"></i></span>
                        </div>
                        @error('account_name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="mb-32 flex-between flex-wrap gap-8">
                <div class="form-check mb-0 flex-shrink-0">
                    <input class="form-check-input flex-shrink-0 rounded-4" type="checkbox" name="snk" value="1" required>
                    <label class="form-check-label text-15 flex-grow-1" for="snk"><a href="#" data-bs-toggle="modal" data-bs-target="#snkModal"> Saya setuju syarat dan ketentuan yang berlaku.</a></label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-main rounded-pill w-100">Kirim Data</button>
        </form>
    </div>
</div>
<!-- Modal SnK -->
<div class="modal fade" id="snkModal" tabindex="-1" aria-labelledby="snkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="snkModalLabel">Mohon dibaca dengan seksama!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
            <h1>Syarat dan Ketentuan Program Afiliasi Kampung Inggris Booster</h1>

<h2>1. Definisi</h2>
<ul>
    <li><strong>Program Afiliasi:</strong> Sebuah program di mana afiliasi mempromosikan kursus bahasa Inggris Kampung Inggris Booster dan mendapatkan komisi berdasarkan hasil penjualan atau pendaftaran yang dilakukan melalui link afiliasi mereka.</li>
    <li><strong>Afiliasi:</strong> Individu atau entitas yang terdaftar dalam Program Afiliasi Kampung Inggris Booster dan memiliki hak untuk mempromosikan kursus yang kami tawarkan.</li>
</ul>

<h2>2. Pendaftaran dan Kualifikasi</h2>
<ul>
    <li><strong>Pendaftaran:</strong> Untuk menjadi afiliasi, Anda harus mendaftar melalui formulir pendaftaran resmi Kampung Inggris Booster.</li>
    <li><strong>Kualifikasi:</strong> Pendaftar harus berusia minimal 18 tahun dan memiliki akun media sosial atau platform online yang aktif untuk mempromosikan kursus kami.</li>
    <li><strong>Persetujuan:</strong> Pendaftaran Anda akan disetujui berdasarkan penilaian Kampung Inggris Booster dan keputusan kami bersifat final.</li>
</ul>

<h2>3. Tugas Afiliasi</h2>
<ul>
    <li><strong>Promosi:</strong> Afiliasi wajib mempromosikan kursus dengan cara yang jujur dan etis melalui saluran yang disetujui, seperti blog, media sosial, atau situs web.</li>
    <li><strong>Konten:</strong> Konten promosi harus sesuai dengan panduan dan materi yang disediakan oleh Kampung Inggris Booster.</li>
    <li><strong>Larangan:</strong> Afiliasi dilarang menggunakan metode promosi yang menyesatkan, spam, atau berpotensi merusak reputasi Kampung Inggris Booster.</li>
</ul>

<h2>4. Komisi dan Pembayaran</h2>
<ul>
    <li><strong>Komisi:</strong> Afiliasi akan menerima komisi berdasarkan persentase dari biaya pendaftaran kursus yang dilakukan melalui link afiliasi mereka.</li>
    <li><strong>Pembayaran:</strong> Pembayaran komisi dilakukan setiap bulan, dengan syarat saldo komisi mencapai batas minimum yang ditetapkan oleh Kampung Inggris Booster.</li>
    <li><strong>Laporan:</strong> Afiliasi akan menerima laporan mengenai klik, pendaftaran, dan komisi mereka melalui panel afiliasi.</li>
</ul>

<h2>5. Tanggung Jawab dan Kewajiban</h2>
<ul>
    <li><strong>Akun Afiliasi:</strong> Afiliasi bertanggung jawab untuk menjaga keamanan akun afiliasi mereka dan tidak boleh membagikannya kepada pihak ketiga.</li>
    <li><strong>Perubahan Data:</strong> Afiliasi harus memberitahukan Kampung Inggris Booster mengenai perubahan data kontak atau informasi rekening bank.</li>
</ul>

<h2>6. Penangguhan dan Penghentian</h2>
<ul>
    <li><strong>Penangguhan:</strong> Kampung Inggris Booster berhak menangguhkan atau menghentikan akun afiliasi jika ada pelanggaran terhadap syarat dan ketentuan ini.</li>
    <li><strong>Penghentian:</strong> Afiliasi dapat menghentikan partisipasi mereka dalam program dengan memberikan pemberitahuan tertulis kepada Kampung Inggris Booster.</li>
</ul>

<h2>7. Hak Kekayaan Intelektual</h2>
<ul>
    <li><strong>Lisensi:</strong> Kampung Inggris Booster memberikan lisensi terbatas, non-eksklusif, dan tidak dapat dipindah-tangankan kepada afiliasi untuk menggunakan materi promosi yang disediakan.</li>
    <li><strong>Hak Cipta:</strong> Semua hak cipta dan hak kekayaan intelektual lainnya yang terkait dengan materi promosi tetap menjadi milik Kampung Inggris Booster.</li>
</ul>

<h2>8. Perubahan Syarat dan Ketentuan</h2>
<ul>
    <li><strong>Perubahan:</strong> Kampung Inggris Booster berhak untuk mengubah syarat dan ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya.</li>
    <li><strong>Pemberitahuan:</strong> Perubahan akan diinformasikan melalui email atau panel afiliasi, dan afiliasi dianggap menyetujui perubahan tersebut dengan melanjutkan partisipasi mereka.</li>
</ul>

<h2>9. Hukum yang Berlaku</h2>
<ul>
    <li><strong>Hukum:</strong> Syarat dan ketentuan ini diatur oleh hukum yang berlaku di negara Republik Indonesia.</li>
    <li><strong>Sengketa:</strong> Setiap sengketa yang timbul dari program afiliasi ini akan diselesaikan melalui jalur hukum yang berlaku di Republik Indonesia.</li>
</ul>
            </div>
        </div>
    </div>
</div>
@endsection