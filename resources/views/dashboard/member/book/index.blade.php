@extends('layouts.app')
@section('main')
    <section class="section">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .card-img-top {
                width: 40px;
                height: 150px;
                /* Adjust the height as needed */
                object-fit: cover;
                /* Ensure the image covers the entire space */
                border-top-left-radius: calc(0.25rem - 1px);
                border-top-right-radius: calc(0.25rem - 1px);
            }

            /* Add this CSS for zoom effect on hover */
            .zoom-card:hover {
                transition: transform 0.4s ease;
                /* Adjust the duration and easing as needed */
                transform: scale(1.1);
                /* Adjust the scaling factor for zoom effect */
            }


            /* Set the <a> tag to display its content without acting as a block */
            .card-link {
                display: contents;
            }

            /* Custom styles for the circular button */
            .btn-circle {
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background-color 0.3s ease;
            }

            .btn-circle:hover {
                background-color: #ff5c62;
                /* Change to the desired hover color */
                color: white;
            }
        </style>
        <div class="section-header">
            <h1>Daftar Buku</h1>
        </div>
        <style>
            .card-img-top {
                width: 322px;
                height: 450px;
                /* Adjust the height as needed */
                object-fit: cover;
                /* Ensure the image covers the entire space */
                border-top-left-radius: calc(0.25rem - 1px);
                border-top-right-radius: calc(0.25rem - 1px);
            }
        </style>

        <div class="row py-5">
            <div class="col-lg-12">
                <h1>Selamat Datang di 40 Library! 👋🏻</h1>
            </div>

            {{-- <h1>{{ auth()->user()->rombel_id }}</h1> --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('successEdit'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {!! session('successEdit') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('successDelete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! session('successDelete') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="container-fluid">
                <!-- Search and filter form -->
                <div class="row">
                    <div class="col-lg-8 my-5">
                        <form method="GET">
                            <div class="input-group">
                                <select class="form-control selectric mx-2" name="category">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request()->get('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control" placeholder="Cari buku ..." name="search_keyword"
                                    value="{{ request()->get('search_keyword') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    @forelse ($books as $item)
                        <div class="col-md-3 col-lg-3">
                            <div class="card-container zoom-card">
                                <!-- Wrap the card content with the <a> tag and assign the card-link class -->
                                <a href="/books/{{ $item->id }}" class="card-link">
                                    <div class="card d-flex">
                                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                                            alt="..." height="250">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $item->title }}</h5>
                                            {{-- <p class="card-text my-3 text-muted"> --}}
                                            <div class="text-muted">
                                                {!! Str::limit($item->desc, 50, '...') !!}
                                            </div>
                                            {{-- </p> --}}
                                            <!-- Buttons in one row on the right side -->
                                            <div class="d-flex justify-content-start mt-auto py-3">
                                                <a href="/books/{{ $item->id }}" class="btn btn-primary mr-2"
                                                    style="margin-right: 10px;">Lihat
                                                    Detail</a>
                                                <livewire:favorite-button :bookId="$item->id" :key="$item->id" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="text-center m-5">Buku tidak ditemukan</h2>
                            </div>
                            <div class="col-lg-12 text-center">
                                <img src="{{ asset('img/Search-pana 1.png') }}" alt="" srcset="">
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
