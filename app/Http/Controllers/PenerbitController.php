<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\DataTables\PenerbitDataTable;
use App\Http\Requests\Penerbit\StoreRequest;
use App\Http\Requests\Penerbit\UpdateRequest;

class PenerbitController extends Controller
{
    // Direktori tujuan di dalam folder 'public'
    private $uploadPath = 'images/penerbit/';

    /**
     * Display a listing of the resource.
     */
    public function index(PenerbitDataTable $dataTable)
    {
        return $dataTable->render('admin.datamaster.penerbit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.datamaster.penerbit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            // 1. Definisikan jalur absolut ke folder public
            $destinationPath = public_path($this->uploadPath);

            // Pastikan direktori ada di public folder
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            // 2. Buat nama file unik untuk menghindari konflik penamaan
            // Menggunakan time() untuk memastikan keunikan nama file
            $fileName = time() . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

            // 3. Pindahkan file ke direktori public/images/penerbit
            $file->move($destinationPath, $fileName);

            // 4. Simpan jalur relatif ke database (contoh: images/penerbit/123456-NamaPenerbit.jpg)
            $validatedData['logo'] = $this->uploadPath . $fileName;
        }

        Penerbit::create($validatedData);
        return redirect('/admin/penerbit')->with('suksestambahpenerbit','Data Penerbit berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerbit $penerbit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Penerbit::findOrFail($id);
        return view('admin.datamaster.penerbit.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $data = Penerbit::findOrFail($id);

        if ($request->hasFile('logo')) {
            // Hapus foto lama dari public folder jika ada
            if ($data->logo) {
                $oldFilePath = public_path($data->logo); // Menggunakan jalur dari DB (images/penerbit/...)
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            $file = $request->file('logo');
            $destinationPath = public_path($this->uploadPath);

            // Pastikan direktori ada
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            // Buat nama file unik
            $fileName = time() . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();

            // Pindahkan file baru
            $file->move($destinationPath, $fileName);

            // Simpan jalur relatif baru ke database
            $validatedData['logo'] = $this->uploadPath . $fileName;
        }
        
        // Pastikan logo lama tetap dipertahankan jika tidak ada file baru diunggah
        if (!$request->hasFile('logo') && $data->logo) {
             $validatedData['logo'] = $data->logo;
        } else if (!$request->hasFile('logo') && $request->logo === null) {
            // Jika user menghapus foto tanpa mengupload baru (misal ada field hidden)
            $validatedData['logo'] = null;
        }


        $data->update($validatedData);

        return redirect('/admin/penerbit')->with('suksesupdatepenerbit', 'Data Penerbit berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $penerbit = Penerbit::findOrFail($request->id);

        // Hapus logo dari public folder jika ada
        if (!empty($penerbit->logo)) { // Mengubah $user->foto menjadi $penerbit->logo
            $filePath = public_path($penerbit->logo);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $penerbit->delete(); // Mengubah $user->delete() menjadi $penerbit->delete()

        return redirect('/admin/penerbit')->with('suksesdeletepenerbit', 'Data Penerbit berhasil dihapus');
    }
}
