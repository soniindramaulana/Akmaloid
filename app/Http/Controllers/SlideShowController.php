<?php

namespace App\Http\Controllers;

use App\DataTables\SlideShowDataTable;
use App\Http\Requests\SlideShow\StoreRequest;
use App\Http\Requests\SlideShow\UpdateRequest;
use App\Models\SlideShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; // Import Str untuk slugging nama file

class SlideShowController extends Controller
{
    // Definisikan path upload di folder public
    private $iconPath = 'images/slideshow/icon/';
    private $gambarPath = 'images/slideshow/gambar/';

    /**
     * Display a listing of the resource.
     */
    public function index(SlideShowDataTable $dataTable)
    {
        return $dataTable->render('admin.slideshow.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slideshow.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        // LOGIKA UPLOAD ICON
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $destinationPath = public_path($this->iconPath);
            
            // Buat direktori jika belum ada
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            
            // Buat nama file unik: timestamp-judul.ext
            $fileName = time() . '-' . Str::slug($request->judul) . '-icon.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            
            // Simpan jalur relatif ke database (contoh: images/slideshow/icon/...)
            $validatedData['icon'] = $this->iconPath . $fileName;
        }

        // LOGIKA UPLOAD GAMBAR
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $destinationPath = public_path($this->gambarPath);
            
            // Buat direktori jika belum ada
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            
            // Buat nama file unik: timestamp-judul-bg.ext
            $fileName = time() . '-' . Str::slug($request->judul) . '-bg.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            
            // Simpan jalur relatif ke database (contoh: images/slideshow/gambar/...)
            $validatedData['gambar'] = $this->gambarPath . $fileName;
        }

        SlideShow::create($validatedData);
        return redirect('/admin/slideshow')->with('suksestambahslideshow','Data SlideShow berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SlideShow $slideShow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SlideShow::findOrFail($id);
        return view('admin.slideshow.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $data = SlideShow::findOrFail($id);

        // LOGIKA UPDATE ICON
        if ($request->hasFile('icon')) {
            // Hapus icon lama
            if ($data->icon && File::exists(public_path($data->icon))) {
                File::delete(public_path($data->icon));
            }

            $file = $request->file('icon');
            $destinationPath = public_path($this->iconPath);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $fileName = time() . '-' . Str::slug($request->judul) . '-icon.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validatedData['icon'] = $this->iconPath . $fileName;
        } else {
            // Pertahankan icon lama jika tidak ada upload baru
            $validatedData['icon'] = $data->icon;
        }

        // LOGIKA UPDATE GAMBAR
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($data->gambar && File::exists(public_path($data->gambar))) {
                File::delete(public_path($data->gambar));
            }

            $file = $request->file('gambar');
            $destinationPath = public_path($this->gambarPath);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $fileName = time() . '-' . Str::slug($request->judul) . '-bg.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $validatedData['gambar'] = $this->gambarPath . $fileName;
        } else {
            // Pertahankan gambar lama jika tidak ada upload baru
            $validatedData['gambar'] = $data->gambar;
        }

        $data->update($validatedData);

        return redirect('/admin/slideshow')->with('suksesupdateslideshow', 'Data SlideShow berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $slideShow = SlideShow::findOrFail($request->id); // Mengubah $user menjadi $slideShow

        // Hapus icon jika ada
        if (!empty($slideShow->icon)) {
            $filePath = public_path($slideShow->icon);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        // Hapus gambar jika ada
        if (!empty($slideShow->gambar)) {
            $filePath = public_path($slideShow->gambar);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $slideShow->delete();

        return redirect('/admin/slideshow')->with('suksesdeleteslideshow', 'Data SlideShow berhasil dihapus');
    }
}
