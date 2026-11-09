<?php

namespace App\Http\Controllers;

use App\Models\M_Dosen;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class C_Dosen extends Controller
{
    public function __construct()
    {
        $this->M_Dosen = new M_Dosen();
    }

    // Tampil daftar dosen (Read) — Part 1
    public function index()
    {
        $data = [
            'dosen' => $this->M_Dosen->allData(),
        ];
        return view('v_dosen', $data);
    }

    // Tampil satu data dosen (Detail) — Part 1
    public function detail($id_dosen)
    {
        if (!$this->M_Dosen->detailData($id_dosen)) {
            abort(404);
        }
        $data = [
            'dosen' => $this->M_Dosen->detailData($id_dosen),
        ];
        return view('v_detaildosen', $data);
    }

    // Tampil form tambah dosen — Part 2
    public function add()
    {
        // ID Otomatis (Part 3): id digenerate sistem, tidak diinput manual.
        $data = [
            'id_otomatis' => $this->M_Dosen->getNextId(),
        ];
        return view('v_adddosen', $data);
    }

    // Simpan data dosen baru (Create) — Part 2
    public function insert()
    {
        Request()->validate([
            'nip' => 'required|unique:tb_dosen,nip|min:17|max:18',
            'nama_dosen' => 'required',
            'mata_kuliah' => 'required',
            'foto_dosen' => 'required|mimes:jpg,jpeg,png,bmp|max:1024',
        ], [
            'nip.required' => 'NIP wajib di isi !',
            'nip.unique' => 'NIP ini sudah terdaftar di database !',
            'nip.min' => 'NIP minimal 17 karakter',
            'nip.max' => 'NIP maksimal 18 karakter',
            'nama_dosen.required' => 'Nama Dosen wajib di isi !',
            'mata_kuliah.required' => 'Nama Mata Kuliah wajib di isi !',
            'foto_dosen.required' => 'Foto Dosen wajib di isi !',
        ]);

        // Upload foto: nama file = NIP + ekstensi asli
        $file = Request()->foto_dosen;
        $fileName = Request()->nip . '.' . $file->extension();
        $file->move(public_path('foto_dosen'), $fileName);

        $data = [
            // ID Otomatis (Part 3)
            'id_dosen' => $this->M_Dosen->getNextId(),
            'nip' => Request()->nip,
            'nama_dosen' => Request()->nama_dosen,
            'mata_kuliah' => Request()->mata_kuliah,
            'foto_dosen' => $fileName,
        ];
        $this->M_Dosen->addData($data);

        return redirect()->route('dosen')->with('pesan', 'Data berhasil ditambahkan !');
    }

    // Tampil form edit dosen — Part 2
    public function edit($id_dosen)
    {
        if (!$this->M_Dosen->detailData($id_dosen)) {
            abort(404);
        }
        $data = [
            'dosen' => $this->M_Dosen->detailData($id_dosen),
        ];
        return view('v_editdosen', $data);
    }

    // Update data dosen — Part 2
    public function update($id_dosen)
    {
        Request()->validate([
            'nip' => 'required|min:17|max:18',
            'nama_dosen' => 'required',
            'mata_kuliah' => 'required',
            'foto_dosen' => 'mimes:jpg,jpeg,png,bmp|max:1024',
        ], [
            'nip.required' => 'NIP wajib di isi !',
            'nip.min' => 'NIP minimal 17 karakter',
            'nip.max' => 'NIP maksimal 18 karakter',
            'nama_dosen.required' => 'Nama Dosen wajib di isi !',
            'mata_kuliah.required' => 'Nama Mata Kuliah wajib di isi !',
        ]);

        // Dua cabang: ganti foto atau tidak (Part 2)
        if (Request()->foto_dosen <> "") {
            // Ada foto baru: upload (nama file sama, menimpa file lama)
            $file = Request()->foto_dosen;
            $fileName = Request()->nip . '.' . $file->extension();
            $file->move(public_path('foto_dosen'), $fileName);

            $data = [
                'nip' => Request()->nip,
                'nama_dosen' => Request()->nama_dosen,
                'mata_kuliah' => Request()->mata_kuliah,
                'foto_dosen' => $fileName,
            ];
        } else {
            // Tidak ganti foto: foto lama tetap dipakai
            $data = [
                'nip' => Request()->nip,
                'nama_dosen' => Request()->nama_dosen,
                'mata_kuliah' => Request()->mata_kuliah,
            ];
        }
        $this->M_Dosen->editData($id_dosen, $data);

        return redirect()->route('dosen')->with('pesan', 'Data berhasil diupdate !');
    }

    // Hapus data dosen — Part 2
    public function delete($id_dosen)
    {
        $dosen = $this->M_Dosen->detailData($id_dosen);

        // Hapus file foto fisik dulu (kalau ada)
        if ($dosen && $dosen->foto_dosen <> "") {
            $path = public_path('foto_dosen') . '/' . $dosen->foto_dosen;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->M_Dosen->deleteData($id_dosen);

        return redirect()->route('dosen')->with('pesan', 'Data berhasil dihapus !');
    }

    // Print data dosen ke PDF (dompdf) — Part 3
    public function print()
    {
        $data = [
            'dosen' => $this->M_Dosen->allData(),
        ];

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('v_print', $data)->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('data-dosen.pdf');
    }
}
