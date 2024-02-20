<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index', [
            'title' => 'Profile'
        ]);
    }
    public function edit()
    {
        return view('dashboard.profile.edit', [
            'title' => 'Edit Profile'
        ]);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:100', 'min:3'],
            'email' => 'required|email|max:100|unique:users,email,' . $request->id,
            'username' => 'required|min:3|max:100|unique:users,username,' . $request->id,
            'id_no' => 'required|min:10|max:10|unique:users,id_no,' . $request->id,
            'prof_pic' => ['file', 'image', 'max:10240']
        ], [

            'prof_pic.file' => 'Foto harus berupa file.',
            'prof_pic.image' => 'Foto harus berupa gambar.',
            'prof_pic.max' => 'Foto tidak boleh lebih dari 10 MB.',
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'name.min' => 'Nama minimal harus terdiri dari 3 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email telah digunakan',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter.',
            'id_no.max' => 'NIS/NIP tidak boleh lebih dari 10 karakter.',
            'id_no.min' => 'NIS/NIP minimal harus terdiri dari 10 karakter.',
            'id_no.required' => 'NIS/NIP harus diisi.',
            'id_no.unique' => 'NIS/NIP telah terdaftar.',
            'username.required' => 'Username harus diisi.',
            'username.max' => 'Username tidak boleh lebih dari 25 karakter.',
            'username.min' => 'Username minimal harus terdiri dari 3 karakter.',
            'username.unique' => 'Username telah digunakan',
        ]);
        if ($request->file('prof_pic')) {
            $validatedData['prof_pic'] = $request->file('prof_pic')->store('profile');
        }

        User::where('id', $request->id)->update($validatedData);
        return redirect()->route('profile')->with('successEdit', 'Profile pengguna berhasil diperbarui!');
    }
}
