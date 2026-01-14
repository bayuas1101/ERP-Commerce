<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::with('user')->get();
    }
    
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $user = User::findOrFail($supplier->user_id);

        DB::beginTransaction();

        try {
            // Hapus supplier
            $supplier->delete();
            // Hapus user terkait
            $user->delete();

            DB::commit();

            return response()->json([
                'message' => 'Supplier dan user terkait berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menghapus supplier',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:6',
            'nama_toko'       => 'required|string|max:255',
            'nama_supplier'   => 'required|string|max:255',
            'kontak_person'   => 'required|string|max:255',
            'telepon'         => 'required|string|max:20',
            'alamat'          => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            //1. Buat User Gunakan nama_supplier sebagai nama_user
            $user = User::create([
                'nama_user' => $request->nama_supplier,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => 'supplier',
            ]);

            //2 BUAT SUPPLIER
            $supplier = Supplier::create([
                'user_id'        => $user->id_user,
                'nama_toko'      => $request->nama_toko,
                'nama_supplier'  => $request->nama_supplier,
                'kontak_person'  => $request->kontak_person,
                'telepon'        => $request->telepon,
                'alamat'         => $request->alamat,
            ]);

            DB::commit();

            return response()->json([
                'message'  => 'Supplier berhasil dibuat',
                'supplier' => $supplier
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal membuat supplier',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
