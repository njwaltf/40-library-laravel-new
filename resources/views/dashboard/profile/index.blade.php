@extends('layouts.app')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Profile Saya</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if (session()->has('successEdit'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ session('successEdit') }}
                            </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="@if (auth()->user()->prof_pic > 0) {{ asset('storage/' . auth()->user()->prof_pic) }}
                                @else {{ asset('assets/img/avatar/avatar-1.png') }} @endif"
                                    width="250" height="250" class="rounded-circle" disabled>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="{{ auth()->user()->username }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="full_name" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ auth()->user()->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Alamat Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ auth()->user()->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="id_no" class="form-label">NIS/NIP</label>
                                            <input type="text" class="form-control" id="id_no" name="id_no"
                                                value="{{ auth()->user()->id_no }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <a href="/profile/edit" class="btn btn-primary m-1">Edit Profile</a>
                                <a href="javascript:history.go(-1);" class="btn btn-outline-warning m-1">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
