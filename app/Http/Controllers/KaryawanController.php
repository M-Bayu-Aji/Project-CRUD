<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('pages.karyawan', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:3072', // 3MB in kilobytes
            'name' => 'required|max:16',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required' // tambahkan nullable jika stock tidak wajib
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Maksimal 16 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'jabatan.required' => 'Jabatan wajib di isi',
            'image.mimes' => 'Format gambar yang diperbolehkan hanya PNG, JPG, JPEG',
            'image.max' => 'Ukuran gambar maksimal 3MB',
            'image.required' => 'Gambar wajib diisi'
        ]);
    
        // Cek apakah ada file yang diupload
        if ($request->hasFile('image')) {
            // Ambil file dari request
            $file = $request->file('image');
    
            // Buat nama file unik menggunakan waktu dan nama asli file
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Simpan file ke folder public/images
            $file->move(public_path('images'), $filename);
    
            // Simpan data produk ke dalam database, termasuk path gambar
            Karyawan::create([
                'name' => $request->input('name'),
                'jenis kelamin' => $request->input('jenis kelamin'),
                'jabtan' => $request->input('jabatan'),
                'image' => 'images/' . $filename, // Simpan path gambar
            ]);
        }
    
        return redirect()->route('karyawan.karyawan_page')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawan = Karyawan::find($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|max:16',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required'
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Maksimal 16 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'jabatan.required' => 'Jabatan wajib di isi',
            'image.mimes' => 'Format gambar yang diperbolehkan hanya PNG, JPG, JPEG',
            'image.max' => 'Ukuran gambar maksimal 3MB',
        ]);
    
        // Ambil produk berdasarkan ID
        $karyawan = Karyawan::findOrFail($id);
    
        // Cek apakah ada file gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($karyawan->image && file_exists(public_path($karyawan->image))) {
                unlink(public_path($karyawan->image));
            }
    
            // Upload gambar baru
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
    
            // Simpan path gambar baru
            $karyawan->image = 'images/' . $filename;
        }
    
        // Update data lainnya
        $karyawan->name = $request->input('name');
        $karyawan->jenis_kelamin = $request->input('jenis_kelamin');
        $karyawan->jabatan = $request->input('jabatan');
    
        // Simpan perubahan
        $karyawan->save();
    
        return redirect()->route('karyawan.karyawan_page')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Karyawan::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Karyawan!');
    }
}
