<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id_user|unique:admin,user_id',
            'nama_lengkap'   => 'required|string|max:255',
        ]);

        $admin = Admin::create($request->all());
        return response()->json([
            'message' => 'Admin berhasil dibuat',
            'data'    => $admin
        ], 201);
    }

    public function show($id)
    {
        return Admin::findOrFail($id);
    }
}
