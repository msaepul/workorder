<?php

use App\Models\User;
use App\Models\Cabang;
use App\Models\perangkat;
use App\Models\Sparepart;
use App\Models\Supplier;
use App\Models\Jenis;
use App\Models\workorder;
use App\Models\Modelakses;
use App\Models\Modelutama;
use Illuminate\Support\Facades\Auth;

if (!function_exists(function: 'cabang')) {
    function cabang()
    {
        $idcabang = Auth::user()->cabang;
        $arraycabang = Cabang::where('id', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->cabang;

        return "$cabang";
    }
}


if (!function_exists('getUserId')) {
    function getUserId()
    {
        $id = Auth::user()->id;
        return $id;
    }
}

if (!function_exists('getUserDept')) {
    function getUserDept()
    {
        $dept = Auth::user()->dept;
        return $dept;
    }
}

if (!function_exists('getDeptUser')) {
    function getDeptUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $dept = $user->dept;
            return $dept;
        }

        return null; // Atau nilai default yang sesuai jika pengguna dengan ID tersebut tidak ditemukan
    }
}

if (!function_exists('getUserCabang')) {
    function getUserCabang()
    {
        $cabang = Auth::user()->cabang;
        return $cabang;
    }
}
if (!function_exists('getFullName')) {
    function getFullName($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $nama_lengkap = $user->nama_lengkap;
            return $nama_lengkap;
        }

        return null; // Atau nilai default yang sesuai jika pengguna dengan ID tersebut tidak ditemukan
    }
}

if (!function_exists('getNamePerangkat')) {
    function getNamePerangkat($id)
    {
        $perangkat = perangkat::find($id);

        if ($perangkat) {
            $nama_perangkat = $perangkat->nama_perangkat;
            return $nama_perangkat;
        }

        return null; // Atau nilai default yang sesuai jika pengguna dengan ID tersebut tidak ditemukan
    }
}

if (!function_exists('getNamesparepart')) {
    function getNamesparepart($id)
    {
        $sparepart = Sparepart::find($id);

        if ($sparepart) {
            $nama_sparepart = $sparepart->nama_sparepart;
            return $nama_sparepart;
        }

        return null; // Atau nilai default yang sesuai jika pengguna dengan ID tersebut tidak ditemukan
    }
}
if (!function_exists('getNamejenis')) {
    function getNamejenis($id)
    {
        $jenis = jenis::find($id);

        if ($jenis) {
            $nama_jenis = $jenis->jenis_perangkat;
            return $nama_jenis;
        }

        return null; // Atau nilai default yang sesuai jika pengguna dengan ID tersebut tidak ditemukan
    }
}


if (!function_exists(function: 'cabangs')) {
    function cabangs()
    {
        $idcabang = Auth::user()->cabang;
        $arraycabang = Cabang::where('id', '=', "$idcabang")
            ->get()
            ->first();
        $cabangs = $arraycabang->ket;

        return "$cabangs";
    }
}

if (!function_exists(function: 'dept')) {
    function dept()
    {
        $idcabang = Auth::user()->dept;
        $arraycabang = Cabang::where('id', '=', "$idcabang")
            ->get()
            ->first();
        $cabangs = $arraycabang->ket;

        return "$cabangs";
    }
}

if (!function_exists('getSupplierName')) {
    function getSupplierName($id)
    {
        $supplier = Supplier::find($id);

        if ($supplier) {
            $nama_supplier = $supplier->nama_supplier;
            return $nama_supplier;
        }

        return null; // Atau nilai default yang sesuai jika pengguna dengan ID tersebut tidak ditemukan
    }
}



if (!function_exists(function: 'gender')) {
    function gender()
    {
        $idgender = Auth::user()->gender;
        if ($idgender == 1) {
            $gender = 'Laki - Laki';
        } else {
            $gender = 'Perempuan';
        }

        return "$gender";
    }
}

if (!function_exists(function: 'marital')) {
    function marital()
    {
        $idmarital = Auth::user()->marital;
        if ($idmarital == 1) {
            $marital = 'Menikah';
        } else {
            $marital = 'Belum Menikah';
        }

        return "$marital";
    }
}

// if (!function_exists(function: 'akses')) {
//     function akses()
//     {
//         $iduser = Auth::user()->id;
//         $arrayakses = Modelakses::where('id', '=', "$iduser")->get()->first();
//         $data = [
//             'MKT' => $arrayakses->MKT,
//             'PRC' => $arrayakses->PRC,
//             'PBL' => $arrayakses->PBL,
//             'GBB' => $arrayakses->GBB,
//             'PRO' => $arrayakses->PRO,
//             'ENG' => $arrayakses->ENG,
//             'QCT' => $arrayakses->QCT,
//             'GPJ' => $arrayakses->GPJ,
//             'EKS' => $arrayakses->EKS,
//             'KND' => $arrayakses->KND,
//             'FIN' => $arrayakses->FIN,
//             'ACC' => $arrayakses->ACC,
//             'HRD' => $arrayakses->HRD,
//             'SIS' => $arrayakses->SIS,
//             'EDP' => $arrayakses->EDP,
//             'TAX' => $arrayakses->TAX,
//             'GRR' => $arrayakses->GRR,
//             'RND' => $arrayakses->RND,
//             'GSP' => $arrayakses->GSP,
//             'BM' => $arrayakses->BM,
//             'CRT' => $arrayakses->CRT,
//         ];
//         return $data;
//     }
// }

// if (!function_exists(function: 'allakses')) {
//     function allakses()
//     {
//         $allakses = [];
//         if (akses()['MKT'] ==  1) {
//             array_push($allakses, "MKT");
//         }
//         if (akses()['PRC'] == 1) {
//             array_push($allakses, "PRC");
//         }
//         if (akses()['PBL'] == 1) {
//             array_push($allakses, "PBL");
//         }
//         if (akses()['GBB'] == 1) {
//             array_push($allakses, "GBB");
//         }
//         if (akses()['PRO'] == 1) {
//             array_push($allakses, "PRO");
//         }
//         if (akses()['ENG'] == 1) {
//             array_push($allakses, "ENG");
//         }
//         if (akses()['QCT'] == 1) {
//             array_push($allakses, "QCT");
//         }
//         if (akses()['GPJ'] == 1) {
//             array_push($allakses, "GPJ");
//         }
//         if (akses()['EKS'] == 1) {
//             array_push($allakses, "EKS");
//         }
//         if (akses()['KND'] == 1) {
//             array_push($allakses, "KND");
//         }
//         if (akses()['FIN'] == 1) {
//             array_push($allakses, "FIN");
//         }
//         if (akses()['ACC'] == 1) {
//             array_push($allakses, "ACC");
//         }
//         if (akses()['HRD'] == 1) {
//             array_push($allakses, "HRD");
//         }
//         if (akses()['SIS'] == 1) {
//             array_push($allakses, "SIS");
//         }
//         if (akses()['EDP'] == 1) {
//             array_push($allakses, "EDP");
//         }
//         if (akses()['TAX'] == 1) {
//             array_push($allakses, "TAX");
//         }
//         if (akses()['GRR'] == 1) {
//             array_push($allakses, "GRR");
//         }
//         if (akses()['RND'] == 1) {
//             array_push($allakses, "RND");
//         }
//         if (akses()['GSP'] == 1) {
//             array_push($allakses, "GSP");
//         }
//         if (akses()['BM'] == 1) {
//             array_push($allakses, "BM");
//         }
//         if (akses()['CRT'] == 1) {
//             array_push($allakses, "CRT");
//         }

//         return implode(", ", $allakses);
//     }
// }

// if (!function_exists(function: 'arrayakses')) {
//     function arrayakses()
//     {
//         $arrayakses = [];
//         if (akses()['MKT'] ==  1) {
//             array_push($arrayakses, "MKT");
//         }
//         if (akses()['PRC'] == 1) {
//             array_push($arrayakses, "PRC");
//         }
//         if (akses()['PBL'] == 1) {
//             array_push($arrayakses, "PBL");
//         }
//         if (akses()['GBB'] == 1) {
//             array_push($arrayakses, "GBB");
//         }
//         if (akses()['PRO'] == 1) {
//             array_push($arrayakses, "PRO");
//         }
//         if (akses()['ENG'] == 1) {
//             array_push($arrayakses, "ENG");
//         }
//         if (akses()['QCT'] == 1) {
//             array_push($arrayakses, "QCT");
//         }
//         if (akses()['GPJ'] == 1) {
//             array_push($arrayakses, "GPJ");
//         }
//         if (akses()['EKS'] == 1) {
//             array_push($arrayakses, "EKS");
//         }
//         if (akses()['KND'] == 1) {
//             array_push($arrayakses, "KND");
//         }
//         if (akses()['FIN'] == 1) {
//             array_push($arrayakses, "FIN");
//         }
//         if (akses()['ACC'] == 1) {
//             array_push($arrayakses, "ACC");
//         }
//         if (akses()['HRD'] == 1) {
//             array_push($arrayakses, "HRD");
//         }
//         if (akses()['SIS'] == 1) {
//             array_push($arrayakses, "SIS");
//         }
//         if (akses()['EDP'] == 1) {
//             array_push($arrayakses, "EDP");
//         }
//         if (akses()['TAX'] == 1) {
//             array_push($arrayakses, "TAX");
//         }
//         if (akses()['GRR'] == 1) {
//             array_push($arrayakses, "GRR");
//         }
//         if (akses()['RND'] == 1) {
//             array_push($arrayakses, "RND");
//         }
//         if (akses()['GSP'] == 1) {
//             array_push($arrayakses, "GSP");
//         }
//         if (akses()['BM'] == 1) {
//             array_push($arrayakses, "BM");
//         }
//         if (akses()['CRT'] == 1) {
//             array_push($arrayakses, "CRT");
//         }

//         return $arrayakses;
//     }
// }

if (!function_exists(function: 'lastedit')) {
    function lastedit($iduser)
    {
        if ($iduser == NULL || $iduser == '' || $iduser == '-') {
            return "";
        } else {
            $arrayuser = User::where('id', '=', "$iduser")
                ->get()
                ->first();
            $user = $arrayuser->nama_lengkap;

            return "$user";
        }
    }
}


if (!function_exists(function: 'caricabang')) {
    function caricabang($idcabang)
    {
        $arraycabang = Cabang::where('id', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->cabang;

        return "$cabang";
    }
}

if (!function_exists(function: 'caricabangs')) {
    function caricabangs($idcabangs)
    {
        $arraycabangs = Cabang::where('id', '=', "$idcabangs")
            ->get()
            ->first();
        $cabangs = $arraycabangs->ket;

        return "$cabangs";
    }
}

if (!function_exists(function: 'limits')) {
    function limits($text, $limit = 18)
    {
        if (strlen($text) > $limit) {
            $word = mb_substr($text, 0, $limit - 3) . '...';
        } else {
            $word = $text;
        }
        return $word;
    }
}

if (!function_exists(function: 'kategori')) {
    function kategori($kategori)
    {
        if ($kategori == null) {
            return '-';
        } elseif ($kategori == '') {
            return '-';
        } else {
            $katname = [1 => 'ADMINISTRASI', 'KELUHAN PELANGGAN', '7 WASTE', '5 R', 'PATROL', 'PENCAPAIAN SASARAN MUTU', 'K3', 'BERDAMPAK PADA MUTU', 'KARTU TELUSUR', 'BENDA ASING', 'LABEL', 'HAMA', 'BAHAN BAKU', 'PACKING', 'SELAI', 'ADONAN', 'BENTUK TIDAK SESUAI', 'JAMUR', 'TELAT PACKING', 'RASA', 'TIDAK SESUAI KAPASITAS', 'AMI', 'TRANSPORTATION', 'INVENTORY', 'MOTION', 'WAITING', 'OVERPRODUCTION', 'OVERPROCESSING', 'DEFECTS'];

            return $katname[(int) $kategori];
        }
    }
}

if (!function_exists(function: 'random_str')) {
    function random_str(int $length = 64, string $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        if ($length < 1) {
            throw new \RangeException('Length must be a positive integer');
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces[] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}

// if (!function_exists(function: 'warning')) {
//     function warning()
//     {
//         $cabang = cabang();
//         $dept = Auth::user()->dept;
//         $akses = arrayakses();
//         $NewDate = Date('Y-m-d', strtotime('-3 days'));


//         if ($cabang == 'HO' && $dept == 'SIS') {
//             $warning = Modelutama::where('status', '=', 'draft')
//                 ->where('jenis', '=', 'eksternal')
//                 ->where('tgl', '<', "$NewDate")
//                 ->count();
//         } elseif ($dept == 'SIS' || $dept == 'BM') {
//             $warning = Modelutama::where('kepada', '=', "$cabang")
//                 ->where('status', '=', 'draft')
//                 ->where('tgl', '<', "$NewDate")
//                 ->count();
//         } else {
//             $warning = Modelutama::where('kepada', '=', "$cabang")
//                 ->Wherein('k_dept', $akses)
//                 ->where('status', '=', 'draft')
//                 ->where('tgl', '<', "$NewDate")
//                 ->count();
//         }

//         return "$warning";
//     }
// }


//TANGGAL
if (!function_exists(function: 'tgl_id')) {
    function tgl_id($tanggal)
    {
        if ($tanggal == null) {
            return '-';
        } elseif ($tanggal == '') {
            return '-';
        } else {
            $bulan = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
            $split = explode('-', $tanggal);
            $hasil_tgl = $bulan[(int) $split[0]];

            return $hasil_tgl;
        }
    }
}
if (!function_exists('bulan_angka')) {
    function bulan_angka($bulan)
    {
        $bulan = strtolower($bulan);
        $bulan_romawi = ['i', 'ii', 'iii', 'iv', 'v', 'vi', 'vii', 'viii', 'ix', 'x', 'xi', 'xii'];
        $index = array_search($bulan, $bulan_romawi);
        $angka = ($index !== false) ? ($index + 1) : null;
        $angka = str_pad($angka, 2, '0', STR_PAD_LEFT);
        return $angka;
    }
}



// if (!function_exists(function: 'tglid')) {
//     function tglid($tanggal)
//     {
//         if ($tanggal == null) {
//             return '-';
//         } elseif ($tanggal == '') {
//             return '-';
//         } else {
//             $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
//             $split = explode('-', $tanggal);
//             $hasil_tgl = $split[0] . '-' . $bulan[(int) $split[1]] . '-' . $split[2];

//             return $hasil_tgl;
//         }
//     }
// }

// if (!function_exists(function: 'tgl')) {
//     function tgl($tanggal)
//     {
//         if ($tanggal == null) {
//             return '-';
//         } elseif ($tanggal == '') {
//             return '-';
//         } else {
//             $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
//             $split = explode('-', $tanggal);
//             $hasil_tgl = $split[2] . '-' . $bulan[(int) $split[1]] . '-' . $split[0];

//             return $hasil_tgl;
//         }
//     }
// }

// if (!function_exists(function: 'tgl2')) {
//     function tgl2($tanggal)
//     {
//         if ($tanggal == null) {
//             return '-';
//         } elseif ($tanggal == '') {
//             return '-';
//         } else {
//             $split = explode('-', $tanggal);
//             $hasil_tgl = $split[1] . '/' . $split[2] . '/' . $split[0];

//             return $hasil_tgl;
//         }
//     }
// }

// if (!function_exists(function: 'tgl3')) {
//     function tgl3($tanggal)
//     {
//         if ($tanggal == null) {
//             return '-';
//         } elseif ($tanggal == '') {
//             return '-';
//         } else {
//             $split = explode('-', $tanggal);
//             $hasil_tgl = $split[2] . '-' . $split[1] . '-' . substr($split[0], 2, 2);

//             return $hasil_tgl;
//         }
//     }
// }

// if (!function_exists(function: 'tgl4')) {
//     function tgl4($tanggal)
//     {
//         if ($tanggal == null) {
//             return '-';
//         } elseif ($tanggal == '') {
//             return '-';
//         } else {
//             $split = explode('-', $tanggal);
//             $hasil_tgl = $split[2] . '-' . $split[1] . '-' . $split[0];

//             return $hasil_tgl;
//         }
//     }
// }
