@extends('layouts.app')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pengguna</h1>
        </div>
        @foreach ($user as $item)
            <form action="/users-management-edit" method="POST">
                <input type="hidden" name="id" value="{{ $item->id }}" enctype="multipart/form">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Informasi Pengguna</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <p>Isikan nama lengkap pengguna.</p>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $item->name) }}">
                                            @error('name')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="id_no" class="form-label">NIS/NIP</label>
                                            <p>Isikan NIS/NIP pengguna</p>
                                            <input type="number" class="form-control @error('id_no') is-invalid @enderror"
                                                id="id_no" name="id_no" value="{{ old('id_no', $item->id_no) }}">
                                            @error('id_no')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="username" class="form-label">Username</label>
                                            <p>Isikan nama pengguna.</p>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror" id="username"
                                                name="username" value="{{ old('username', $item->username) }}">
                                            @error('username')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email</label>
                                            <p>Isikan alamat email.</p>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $item->email) }}">
                                            @error('email')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="role" class="form-label">Peran</label>
                                            <p>Atur Peran Pengguna.</p>
                                            <div class="form-group">
                                                <div class="selectgroup w-100">
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="role" value="member"
                                                            class="selectgroup-input"
                                                            @if (old('role', $item->role) === 'member') checked @endif>
                                                        <span class="selectgroup-button selectgroup-button-icon"><i
                                                                class="fas fa-user-check"></i> Member</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="role" value="librarian"
                                                            class="selectgroup-input"
                                                            @if (old('role', $item->role) === 'librarian') checked @endif>
                                                        <span class="selectgroup-button selectgroup-button-icon"><i
                                                                class="fas fa-users-cog"></i> Pustakawan</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="role" value="admin"
                                                            class="selectgroup-input"
                                                            @if (old('role', $item->role) === 'admin') checked @endif>
                                                        <span class="selectgroup-button selectgroup-button-icon"><i
                                                                class="fas fa-user-lock"></i> Admin</span>
                                                    </label>
                                                </div>
                                            </div>
                                            @error('role')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-primary" style="margin-right: 15px">Tambah Pengguna <i
                                class="fas fa-user-plus"></i></button>
                        <a href="/users-management" class="btn btn-outline-warning">Batal</a>
                    </div>
                </div>
            </form>
        @endforeach
        <script>
            const previewImage = (event) => {
                /**
                 * Get the selected files.
                 */
                const imageFiles = event.target.files;
                /**
                 * Count the number of files selected.
                 */
                const imageFilesLength = imageFiles.length;
                /**
                 * If at least one image is selected, then proceed to display the preview.
                 */
                if (imageFilesLength > 0) {
                    /**
                     * Get the image path.
                     */
                    const imageSrc = URL.createObjectURL(imageFiles[0]);
                    /**
                     * Select the image preview element.
                     */
                    const imagePreviewElement = document.querySelector("#preview-selected-image");
                    /**
                     * Assign the path to the image preview element.
                     */
                    imagePreviewElement.src = imageSrc;
                    /**
                     * Show the element by changing the display value to "block".
                     */
                    imagePreviewElement.style.display = "block";
                }
            };
        </script>
    </section>
@endsection
