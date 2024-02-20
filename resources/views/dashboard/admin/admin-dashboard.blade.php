@extends('layouts.app')
@section('main')
    <script>
        // dashboard.js

        document.addEventListener("DOMContentLoaded", function() {
            fetchChartData()
                .then(data => {
                    initializeChart(data);
                })
                .catch(error => {
                    console.error('Error fetching chart data:', error);
                });
        });

        function fetchChartData() {
            return fetch('/api/booking/statistics')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch data');
                    }
                    return response.json();
                });
        }

        function initializeChart(data) {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(data), // Get the statuses as labels
                    datasets: [{
                        label: 'Booking Statistics',
                        data: Object.values(data), // Get the counts as data values
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    </script>
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Admin</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Admin</h4>
                        </div>
                        <div class="card-body">
                            {{ $adminCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pustakawan</h4>
                        </div>
                        <div class="card-body">
                            {{ $librarianCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Member</h4>
                        </div>
                        <div class="card-body">
                            {{ $memberCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pengguna</h4>
                        </div>
                        <div class="card-body">
                            {{ $userCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-dark">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Buku</h4>
                        </div>
                        <div class="card-body">
                            {{ $bookCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Kategori Buku</h4>
                        </div>
                        <div class="card-body">
                            {{ $categoryCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Buku Dipinjam</h4>
                        </div>
                        <div class="card-body">
                            {{ $bookingCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Peminjaman Terlambat</h4>
                        </div>
                        <div class="card-body">
                            {{ $lateBookingCount }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Statistics</h4>
                        <div class="card-header-action">
                            {{-- <div class="btn-group">
                                <a href="#" class="btn btn-primary">Week</a>
                                <a href="#" class="btn">Month</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="182"></canvas>
                        <div class="statistic-details mt-sm-4">

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
                                        <div class="float-right text-primary">{{ $item->book_at }}</div>
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
                            <a href="/bookings-management" class="btn btn-primary btn-lg btn-round">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
