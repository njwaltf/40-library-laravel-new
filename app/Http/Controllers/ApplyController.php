<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplyRequest;
use App\Http\Requests\UpdateApplyRequest;
use App\Models\Apply;
use App\Models\User;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index1()
    {
        return view('apply', [
            'title' => 'Form Pengajuan Akun',
        ]);
    }

    public function index(Request $request)
    {
        $query = Apply::query();

        // Apply search
        if ($request->filled('search_keyword')) {
            $keyword = $request->input('search_keyword');
            $query->search($keyword);
        }

        // Apply role filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->FilterByStatus($status);
        }

        // Get the final result
        $applies = $query->get();
        return view('dashboard.admin.apply.index', [
            'title' => 'Daftar Pengajuan Akun',
            'applies' => $applies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:100', 'min:3'],
            'email' => ['email', 'required', 'max:100', 'unique:users'],
            'username' => ['required', 'max:25', 'min:3', 'unique:users'],
            'password' => ['min:8', 'required', 'max:100'],
            'id_no' => ['required', 'max:10', 'min:10', 'unique:users'],
            'id_card_img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5048'],
            'identity_img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5048']
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'name.min' => 'Nama minimal harus terdiri dari 3 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.required' => 'Email harus diisi.',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter.',
            'email.unique' => 'Email tidak bisa dipakai.',
            'id_no.max' => 'NIS/NIP tidak boleh lebih dari 10 karakter.',
            'id_no.min' => 'NIS/NIP minimal harus terdiri dari 10 karakter.',
            'id_no.required' => 'NIS/NIP harus diisi.',
            'id_no.unique' => 'NIS/NIP tidak bisa dipakai.',
            'role.required' => 'Role harus dipilih.',
            'username.required' => 'Username harus diisi.',
            'username.max' => 'Username tidak boleh lebih dari 25 karakter.',
            'username.min' => 'Username minimal harus terdiri dari 3 karakter.',
            'username.unique' => 'Username tidak bisa dipakai.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'password.required' => 'Password harus diisi.',
            'password.max' => 'Password tidak boleh lebih dari 100 karakter.',
            'id_card_img.required' => 'Foto Kartu Identitas harus diunggah.',
            'id_card_img.image' => 'File yang diunggah harus berupa gambar.',
            'id_card_img.mimes' => 'Format file yang diunggah harus jpeg, png, jpg, atau gif.',
            'id_card_img.max' => 'Ukuran file tidak boleh lebih dari 5MB.',
            'identity_img.required' => 'Foto Diri dengan Kartu Identitas harus diunggah.',
            'identity_img.image' => 'File yang diunggah harus berupa gambar.',
            'identity_img.mimes' => 'Format file yang diunggah harus jpeg, png, jpg, atau gif.',
            'identity_img.max' => 'Ukuran file tidak boleh lebih dari 5MB.'
        ]);
        // status diajukan
        $validatedData['status'] = 'Diajukan';
        // Check if a new image is being uploaded
        if ($request->file('id_card_img')) {
            $validatedData['id_card_img'] = $request->file('id_card_img')->store('id-card-images');
        }
        if ($request->file('identity_img')) {
            $validatedData['identity_img'] = $request->file('identity_img')->store('identity-images');
        }
        Apply::create($validatedData);
        // success
        return redirect('/')->with('successApply', 'Pengajuan akun berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apply $applies_management)
    {
        return view('dashboard.admin.apply.show', [
            'apply' => $applies_management,
            'title' => 'Detail Pengajuan'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apply $applies_management)
    {
        return view('dashboard.admin.apply.edit', [
            'apply' => $applies_management,
            'title' => 'Proses Pengajuan Akun'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplyRequest $request, Apply $applies_management)
    {
        $validatedData = $request->validate([
            'status' => ['required']
        ], [
            'status.required' => 'Status wajib dipilih'
        ]);

        if ($validatedData['status'] === 'Terverifikasi') {
            // buat akun
            $userData = [
                'name' => $applies_management->name,
                'username' => $applies_management->username,
                'email' => $applies_management->email,
                'id_no' => $applies_management->id_no,
                'password' => bcrypt($applies_management->password),
                'role' => 'member'
            ];
            User::create($userData);
            // update status
            $applies_management->update($validatedData);

        } else {
            // update status
            $applies_management->update($validatedData);
        }
        return redirect('/applies-management')->with('success', 'Data pengajuan berhasil diproses!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apply $apply)
    {
        //
    }
}
