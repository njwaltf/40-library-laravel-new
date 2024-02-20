<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRController extends Controller
{
    public function index()
    {
        return view("qr.index", [
            "title" => 'Scan QR Peminjaman',
        ]);
    }
}
