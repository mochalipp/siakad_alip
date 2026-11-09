<?php

namespace App\Http\Controllers;

use App\Models\M_Mahasiswa;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class C_Mahasiswa extends Controller
{
    public function __construct()
    {
        $this->M_Mahasiswa = new M_Mahasiswa();
    }

    // Tampil daftar mahasiswa (Read) — latihan Part 1
    public function index()
    {
        $data = [
            'mahasiswa' => $this->M_Mahasiswa->allData(),
        ];
        return view('v_mahasiswa', $data);
    }

    // Tampil satu data mahasiswa (Detail) — latihan Part 1
    public function detail($nim)
    {
        if (!$this->M_Mahasiswa->detailData($nim)) {
            abort(404);
        }
        $data = [
            'mahasiswa' => $this->M_Mahasiswa->detailData($nim),
        ];
        return view('v_detailmahasiswa', $data);
    }

    // Tampil form tambah mahasiswa — latihan Part 2
    public function add()
    {
        return view('v_addmahasiswa');
    }

    // Simpan data mahasiswa baru (Create) — latihan Part 2
    public function insert()
    {
        Request()->validate([
            'nim' => 'required|unique:tb_mahasiswa,nim|max:20',
            'nama' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'tingkat' => 'required|integer',
            'semester' => 'required|integer',
            'no_hp' => 'required|min:10|max:20',
            'foto' => 'required|mimes:jpg,jpeg,png,bmp|max:1024',
        ], [
            'nim.required' => 'NIM wajib di isi !',
            'nim.unique' => 'NIM ini sudah terdaftar di database !',
            'nim.max' => 'NIM maksimal 20 karakter',
            'nama.required' => 'Nama wajib di isi !',
            'jurusan.required' => 'Jurusan wajib di isi !',
            'prodi.required' => 'Prodi wajib di isi !',
            'ttl.required' => 'Tempat Tanggal Lahir wajib di isi !',
            'alamat.required' => 'Alamat wajib di isi !',
            'agama.required' => 'Agama wajib di isi !',
            'tingkat.required' => 'Tingkat wajib di isi !',
            'semester.required' => 'Semester wajib di isi !',
            'no_hp.required' => 'Nomor Handphone wajib di isi !',
            'foto.required' => 'Foto wajib di isi !',
        ]);

        // Upload foto: nama file = NIM + ekstensi asli
        $file = Request()->foto;
        $fileName = Request()->nim . '.' . $file->extension();
        $file->move(public_path('foto_mahasiswa'), $fileName);

        $data = [
            'nim' => Request()->nim,
            'nama' => Request()->nama,
            'jurusan' => Request()->jurusan,
            'prodi' => Request()->prodi,
            'ttl' => Request()->ttl,
            'alamat' => Request()->alamat,
            'agama' => Request()->agama,
            'tingkat' => Request()->tingkat,
            'semester' => Request()->semester,
            'no_hp' => Request()->no_hp,
            'foto' => $fileName,
        ];
        $this->M_Mahasiswa->addData($data);

        return redirect()->route('mahasiswa')->with('pesan', 'Data berhasil ditambahkan !');
    }

    // Tampil form edit mahasiswa — latihan Part 2
    public function edit($nim)
    {
        if (!$this->M_Mahasiswa->detailData($nim)) {
            abort(404);
        }
        $data = [
            'mahasiswa' => $this->M_Mahasiswa->detailData($nim),
        ];
        return view('v_editmahasiswa', $data);
    }

    // Update data mahasiswa — latihan Part 2
    public function update($nim)
    {
        $mahasiswa = $this->M_Mahasiswa->detailData($nim);
        if (!$mahasiswa) {
            abort(404);
        }

        Request()->validate([
            'nim' => 'required|max:20|unique:tb_mahasiswa,nim,' . $nim . ',nim',
            'nama' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'tingkat' => 'required|integer',
            'semester' => 'required|integer',
            'no_hp' => 'required|min:10|max:20',
            'foto' => 'mimes:jpg,jpeg,png,bmp|max:1024',
        ], [
            'nim.required' => 'NIM wajib di isi !',
            'nim.unique' => 'NIM ini sudah terdaftar di database !',
            'nim.max' => 'NIM maksimal 20 karakter',
            'nama.required' => 'Nama wajib di isi !',
            'jurusan.required' => 'Jurusan wajib di isi !',
            'prodi.required' => 'Prodi wajib di isi !',
            'ttl.required' => 'Tempat Tanggal Lahir wajib di isi !',
            'alamat.required' => 'Alamat wajib di isi !',
            'agama.required' => 'Agama wajib di isi !',
            'tingkat.required' => 'Tingkat wajib di isi !',
            'semester.required' => 'Semester wajib di isi !',
            'no_hp.required' => 'Nomor Handphone wajib di isi !',
        ]);

        // Dua cabang: ganti foto atau tidak (pola sama dengan C_Dosen)
        if (Request()->foto <> "") {
            // Ada foto baru: upload
            if ($mahasiswa->foto && file_exists(public_path('foto_mahasiswa/' . $mahasiswa->foto))) {
                unlink(public_path('foto_mahasiswa/' . $mahasiswa->foto));
            }

            $file = Request()->foto;
            $fileName = Request()->nim . '.' . $file->extension();
            $file->move(public_path('foto_mahasiswa'), $fileName);

            $data = [
                'nim' => Request()->nim,
                'nama' => Request()->nama,
                'jurusan' => Request()->jurusan,
                'prodi' => Request()->prodi,
                'ttl' => Request()->ttl,
                'alamat' => Request()->alamat,
                'agama' => Request()->agama,
                'tingkat' => Request()->tingkat,
                'semester' => Request()->semester,
                'no_hp' => Request()->no_hp,
                'foto' => $fileName,
            ];
        } else {
            // Tidak ganti foto: jika NIM berubah dan foto ada, rename file foto agar sesuai NIM baru
            $fileName = $mahasiswa->foto;
            if ($nim != Request()->nim && $mahasiswa->foto) {
                $ext = pathinfo($mahasiswa->foto, PATHINFO_EXTENSION);
                $newFileName = Request()->nim . '.' . $ext;
                $oldPath = public_path('foto_mahasiswa/' . $mahasiswa->foto);
                $newPath = public_path('foto_mahasiswa/' . $newFileName);
                if (file_exists($oldPath)) {
                    rename($oldPath, $newPath);
                }
                $fileName = $newFileName;
            }

            $data = [
                'nim' => Request()->nim,
                'nama' => Request()->nama,
                'jurusan' => Request()->jurusan,
                'prodi' => Request()->prodi,
                'ttl' => Request()->ttl,
                'alamat' => Request()->alamat,
                'agama' => Request()->agama,
                'tingkat' => Request()->tingkat,
                'semester' => Request()->semester,
                'no_hp' => Request()->no_hp,
                'foto' => $fileName,
            ];
        }
        $this->M_Mahasiswa->editData($nim, $data);

        return redirect()->route('mahasiswa')->with('pesan', 'Data berhasil diupdate !');
    }

    // Hapus data mahasiswa — latihan Part 2
    public function delete($nim)
    {
        $mahasiswa = $this->M_Mahasiswa->detailData($nim);

        // Hapus file foto fisik dulu (kalau ada)
        if ($mahasiswa && $mahasiswa->foto <> "") {
            $path = public_path('foto_mahasiswa') . '/' . $mahasiswa->foto;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->M_Mahasiswa->deleteData($nim);

        return redirect()->route('mahasiswa')->with('pesan', 'Data berhasil dihapus !');
    }

    // Print data mahasiswa ke PDF (dompdf) — Part 3
    public function print()
    {
        $data = [
            'mahasiswa' => $this->M_Mahasiswa->allData(),
        ];

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('v_print_mahasiswa', $data)->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('data-mahasiswa.pdf');
    }
}
