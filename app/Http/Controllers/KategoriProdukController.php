<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriProdukDataTable;
use App\Http\Requests\KategoriProduk\StoreRequest;
use App\Http\Requests\KategoriProduk\UpdateRequest;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KategoriProdukController extends Controller
{
    // Direktori tujuan di dalam folder 'public'
    private $uploadPath = 'images/kategori_produk/';

    /**
     * Display a listing of the resource.
     */
    public function index(KategoriProdukDataTable $dataTable)
    {
        return $dataTable->render('admin.datamaster.kategoriproduk.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.datamaster.kategoriproduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            // 1. Definisikan jalur lengkap ke folder public
            $destinationPath = public_path($this->uploadPath);
            
            // Pastikan direktori ada
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            // 2. Buat nama file unik (menggunakan hashName atau nama unik lainnya)
            // Menggunakan nama request->name bisa menyebabkan konflik jika nama kategori sama.
            // Lebih baik menggunakan kombinasi nama unik dan nama asli.
            $fileName = time() . '-' . $request->name . '.' . $file->getClientOriginalExtension();

            // 3. Pindahkan file ke direktori public/images/kategori_produk
            $file->move($destinationPath, $fileName);

            // 4. Simpan jalur relatif ke database (contoh: images/kategori_produk/123456-NamaKategori.jpg)
            $validatedData['foto'] = $this->uploadPath . $fileName;
        }

        KategoriProduk::create($validatedData);
        return redirect('/admin/kategoriproduk')->with('suksestambahkategoriproduk','Data Kategori Produk berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriProduk $kategoriProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = KategoriProduk::findOrFail($id);
        return view('admin.datamaster.kategoriproduk.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $data = KategoriProduk::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama dari public folder jika ada
            if ($data->foto) {
                $oldFilePath = public_path($data->foto);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
            
            $file = $request->file('foto');
            $destinationPath = public_path($this->uploadPath);
            
            // Pastikan direktori ada
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            // Buat nama file unik
            $fileName = time() . '-' . $request->name . '.' . $file->getClientOriginalExtension();

            // Pindahkan file baru
            $file->move($destinationPath, $fileName);

            // Simpan jalur relatif baru ke database
            $validatedData['foto'] = $this->uploadPath . $fileName;
        }

        $data->update($validatedData);

        return redirect('/admin/kategoriproduk')->with('suksesupdatekategoriproduk', 'Data Kategori Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = KategoriProduk::findOrFail($request->id);

        // Hapus foto dari public folder jika ada
        if (!empty($user->foto)) {
            $filePath = public_path($user->foto);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $user->delete();

        return redirect('/admin/kategoriproduk')->with('suksesdeletekategoriproduk', 'Data Kategori Produk berhasil dihapus');
    }
}
