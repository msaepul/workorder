<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TPMController extends Controller
{
    public function TPMRingan()
    {
        return view('TPM.ringan');
    }

    public function TPMBerat()
    {
        return view('TPM.berat');
    }
    public function JadwalTPM()
    {
        return view('TPM.JadwalTPM');
    }
}
