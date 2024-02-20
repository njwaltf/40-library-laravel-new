@extends('layouts.app')
@section('main')
    <style>
        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown button */
        .dropdown .dropdown-button {
            background-color: #6777ef;
            color: #fff;
            padding: 7.5px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        /* Dropdown button hover effect */
        .dropdown .dropdown-button:hover {
            background-color: #5566cc;
        }

        /* Dropdown content */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 1;
            padding: 10px 0;
            animation: fadeInDown 0.5s ease;
        }

        /* Dropdown content links */
        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        /* Dropdown content link hover effect */
        .dropdown-content a:hover {
            background-color: #f2f2f2;
        }

        /* Show dropdown content when hovering over dropdown container */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Animation for dropdown content */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <!-- Success and error messages -->
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if (session()->has('successEdit'))
                    <div class="alert alert-warning alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('successEdit') }}
                        </div>
                    </div>
                @endif

                @if (session()->has('successDelete'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('successDelete') }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Pengajuan</h4>
                    </div>
                    <div class="card-body">
                        <div class="float-right">
                            <a href="/users-management-create" class="btn btn-primary">Tambah
                                Pengguna <i class="fas fa-user-plus"></i></a>
                            <!-- The dropdown content -->
                            <div class="dropdown">
                                <!-- Dropdown button -->
                                <button class="dropdown-button">Export Data <i class="ti ti-file-text"></i></button>
                                <!-- Dropdown content -->
                                <div class="dropdown-content" id="myDropdown">
                                    <a href="{{ url('pdf/export-apply/') }}">PDF</a>
                                    <a href="{{ url('excel/export-apply/') }}">Excel</a>
                                    {{-- <a href="#">Something else here</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="float-left mb-3">
                            <form method="GET">
                                <div class="input-group">
                                    <select class="form-control selectric mx-2" name="status">
                                        <option value="">Semua Status</option>
                                        @foreach (['Diajukan', 'Ditolak', 'Terverifikasi'] as $status)
                                            <option value="{{ $status }}"
                                                {{ request()->get('status') == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" placeholder="Cari pengajuan"
                                        name="search_keyword" value="{{ request()->get('search_keyword') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="section-title mt-0">Light</div> --}}
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Username</th>
                                    {{-- <th scope="col">Email</th> --}}
                                    <th scope="col">NIP/NIS</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($applies as $apply)
                                    <tr>
                                        <th scope="row">{{ $apply->id }}</th>
                                        <td>{{ $apply->name }}</td>
                                        <td>{{ $apply->username }}</td>
                                        {{-- <td>{{ $apply->email }}</td> --}}
                                        <td>{{ $apply->id_no }}</td>
                                        <td>
                                            <span
                                                @if ($apply->status === 'Diajukan') class="badge badge-warning rounded-3 fw-semibold"
                                            @elseif ($apply->status === 'Terverifikasi')
                                                class="badge badge-success rounded-3 fw-semibold"
                                            @elseif ($apply->status === 'Ditolak')
                                                class="badge badge-danger rounded-3 fw-semibold"> @endif>{{ $apply->status }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- detail --}}
                                            <a href="/applies-management/{{ $apply->id }}"
                                                class="btn btn-info m-1">Detail
                                                <i class="fas fa-arrow-right"></i></a>
                                            {{-- update --}}
                                            <a href="/applies-management/{{ $apply->id }}/edit"
                                                class="btn btn-warning m-1">Proses
                                                <i class="fas fa-user-cog"></i></a>
                                            {{-- delete --}}
                                            <form action="/applies-management-delete/{{ $apply->id }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                {{-- @method('delete') --}}
                                                <button class="btn btn-danger m-1" type="submit"
                                                    onclick="return confirm('Apakah kamu yakin ingin menghapus ajuan akun ini?')">Hapus
                                                    <i class="fas fa-user-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
