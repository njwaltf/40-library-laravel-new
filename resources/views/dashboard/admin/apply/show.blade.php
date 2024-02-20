@extends('layouts.app')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1><a href="javascript:history.go(-1);"><i class="fas fa-arrow-left"></i></a> &nbsp;Detail Pengguna</h1>
        </div>
        {{-- @foreach ($user as $apply) --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pengguna</h4>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row my-3">
                                    <div class="col-lg-4 col-sm-12">
                                        <strong class="m-1">Nama Lengkap Pengguna</strong>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <p class="m-1">{{ $apply->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row my-3">
                                    <div class="col-lg-4">
                                        <strong class="m-1">Tanggal Pengajuan</strong>
                                    </div>
                                    <div class="col-lg-3">
                                        <p class="m-1">
                                            {{ \Carbon\Carbon::parse($apply->created_at)->isoFormat('DD MMMM YYYY') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row my-3">
                                    <div class="col-lg-4 col-sm-12">
                                        <strong class="m-1">Username Pengguna</strong>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <p class="m-1">{{ $apply->username }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row my-3">
                                    <div class="col-lg-4 col-sm-12">
                                        <strong class="m-1">Alamat Email</strong>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <p class="m-1">{{ $apply->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row my-3">
                                    <div class="col-lg-4 col-sm-12">
                                        <strong class="m-1">Status</strong>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        @switch($apply->role)
                                            @case('')
                                                <div class="badge badge-warning">Diajukan</div>
                                            @break

                                            @case('Terverifikasi')
                                                <div class="badge badge-success">Terverifikasi</div>
                                            @break

                                            @default
                                                <div class="badge badge-danger">Ditolak</div>
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-3">Bukti Identitas <strong>{{ $apply->name }}</strong></h5>
                    </div>
                    <div class="card-body">
                        <img src="@if ($apply->identity_img > 0) {{ asset('storage/' . $apply->identity_img) }}
                        @else {{ asset('assets/img/user-1.jpg') }} @endif"
                            width="500" height="300">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-3">Foto Kartu Identitas <strong>{{ $apply->name }}</strong></h5>
                    </div>
                    <div class="card-body">
                        <img src="@if ($apply->id_card_img > 0) {{ asset('storage/' . $apply->id_card_img) }}
                        @else {{ asset('assets/img/user-1.jpg') }} @endif"
                            width="500" height="300">
                    </div>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}
    </section>
@endsection
