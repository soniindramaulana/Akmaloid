<?php

namespace App\Http\Controllers;

use App\DataTables\WalletDataTable;
use App\Http\Requests\Wallet\StoreRequest;
use App\Http\Requests\Wallet\UpdateRequest;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;// Pastikan ini diimpor untuk File::exists dan File::delete

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WalletDataTable $dataTable)
    {
        return $dataTable->render('admin.pembayaran.wallet.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pembayaran.wallet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['gambar'] = null; // Default value

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Membuat nama file unik berdasarkan e_wallet
            $fileName = Str::slug($request->e_wallet) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('images/wallet/');
            
            // Pindahkan file langsung ke folder public
            $file->move($destinationPath, $fileName);
            
            // Simpan path relatif ke database
            $validatedData['gambar'] = 'images/wallet/' . $fileName;
        }

        Wallet::create($validatedData);
        return redirect('/admin/wallet')->with('suksestambahwallet','Data Dompet Digital berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Wallet::findOrFail($id);
        return view('admin.pembayaran.wallet.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $data = Wallet::findOrFail($id);
        
        // Simpan path gambar yang sudah ada sebagai default
        $validatedData['gambar'] = $data->gambar;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($data->gambar) {
                $filePath = public_path($data->gambar);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $file = $request->file('gambar');
            // Membuat nama file unik berdasarkan e_wallet
            $fileName = Str::slug($request->e_wallet) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('images/wallet/');

            // Pindahkan file baru langsung ke folder public
            $file->move($destinationPath, $fileName);
            
            // Simpan path relatif ke database
            $validatedData['gambar'] = 'images/wallet/' . $fileName;
        }

        $data->update($validatedData);

        return redirect('/admin/wallet')->with('suksesupdatewallet', 'Data Dompet Digital berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Wallet::findOrFail($request->id);

        // Hapus foto jika ada
        if (!empty($data->gambar)) {
            $filePath = public_path($data->gambar);
            // Cek apakah file benar-benar ada di direktori public
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $data->delete();

        return redirect('/admin/wallet')->with('suksesdeletewallet', 'Data Dompet Digital berhasil dihapus');
    }
}
