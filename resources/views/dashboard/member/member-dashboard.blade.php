@extends('layouts.app')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Member</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Peminjaman</h4>
                        </div>
                        <div class="card-body">
                            {{ $bookings }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Peminjaman Aktif</h4>
                        </div>
                        <div class="card-body">
                            {{ $bookingsDPJ }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Peminjaman Selesai</h4>
                        </div>
                        <div class="card-body">
                            {{ $bookingsDone }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Peminjaman Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @forelse ($latestBookings as $item)
                                <li class="media">
                                    <img class="mr-3 rounded-circle" width="50" alt="avatar"
                                        src="@if ($item->user->prof_pic > 0) {{ asset('storage/' . $item->user->prof_pic) }}
                                        @else {{ asset('assets/img/avatar/avatar-1.png') }} @endif">
                                    <div class="media-body">
                                        <div class="float-right text-primary">{{ date('d-m-Y', strtotime($item->book_at)) }}
                                        </div>
                                        <div class="media-title">{{ $item->user->name }}</div>
                                        @if ($item->status === 'Diajukan')
                                            <span
                                                class="text-small text-muted">{{ $item->username . ' mengajukan peminjaman pada buku ' . $item->book->title }}</span>
                                        @elseif ($item->status === 'Dipinjam')
                                            <span
                                                class="text-small text-muted">{{ $item->username . ' sedang meminjam buku ' . $item->book->title }}</span>
                                        @elseif ($item->status === 'Dikembalikan')
                                            <span
                                                class="text-small text-muted">{{ $item->username . ' telah mengembalikan buku ' . $item->book->title }}</span>
                                        @elseif ($item->status === 'Ditolak')
                                            <span
                                                class="text-small text-muted">{{ 'Kamu menolak peminjaman ' . $item->book->title . ' dari ' . $item->username }}</span>
                                        @elseif ($item->status === 'Dikembalikan Terlambat')
                                            <span
                                                class="text-small text-muted">{{ $item->username . ' terlambat mengembalikan buku ' . $item->book->title }}</span>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li class="media">
                                    <h4 class="text-muted">Belum ada peminjaman</h4>
                                </li>
                            @endforelse
                        </ul>
                        <div class="text-center pt-1 pb-1">
                            <a href="/bookings" class="btn btn-primary btn-lg btn-round">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Online Users</h4>
                        </div>
                        <div class="card-body">
                            47
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
