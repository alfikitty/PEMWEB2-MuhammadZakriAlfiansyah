<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function show()
    {
        return view('mahasiswa', [
            'nama' => 'Muhammad Zakri Alfiansyah',
            'nim' => '0110224153',
            'jurusan' => 'teknik informatika',
            'angkatan' => '2024',
        ]);
    }
}
