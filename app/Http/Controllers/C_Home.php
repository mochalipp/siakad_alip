<?php

namespace App\Http\Controllers;

use App\Models\M_Dosen;
use App\Models\M_Mahasiswa;
use App\Models\M_User;

class C_Home extends Controller
{
    public function __construct()
    {
        $this->M_Dosen = new M_Dosen();
        $this->M_Mahasiswa = new M_Mahasiswa();
        $this->M_User = new M_User();
    }

    // Halaman Home / Dashboard — Part 3
    // Menampilkan jumlah data + chart (Chart.js) di v_home.
    public function index()
    {
        $dosenPerMatkul = $this->M_Dosen->countPerMataKuliah();
        $mhsPerProdi = $this->M_Mahasiswa->countPerProdi();

        $data = [
            'jumlah_dosen' => $this->M_Dosen->allData()->count(),
            'jumlah_mahasiswa' => $this->M_Mahasiswa->allData()->count(),
            'jumlah_user' => $this->M_User->allData()->count(),
            // Data chart: label + jumlah
            'chart_dosen_label' => $dosenPerMatkul->pluck('mata_kuliah'),
            'chart_dosen_data' => $dosenPerMatkul->pluck('jumlah'),
            'chart_mhs_label' => $mhsPerProdi->pluck('prodi'),
            'chart_mhs_data' => $mhsPerProdi->pluck('jumlah'),
        ];
        return view('v_home', $data);
    }

    // Halaman About — Part 1
    public function about()
    {
        return view('v_about');
    }

    // Halaman About dengan parameter id — Part 1
    public function about2($id)
    {
        $data = [
            'id' => $id,
        ];
        return view('v_about', $data);
    }
}
