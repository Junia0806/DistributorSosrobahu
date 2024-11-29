<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAgen;
use App\Models\UserDistributor;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function dataAgen(Request $request)
    {
        $search = $request->input('search');

        // Query untuk mengambil semua data agen
        $akunAgen = UserAgen::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', '%' . $search . '%')
                        ->orWhere('username', 'like', '%' . $search . '%')
                        ->orWhere('no_telp', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            })
            
            ->paginate(10); // Pagination

        // Format respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Data agen berhasil diambil.',
            'data' => $akunAgen,
        ], 200);
    }

    public function dataDistributor(Request $request)
    {
        $search = $request->input('search');

        // Query untuk mengambil semua data agen
        $akunDistributor = UserDistributor::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', '%' . $search . '%')
                        ->orWhere('username', 'like', '%' . $search . '%')
                        ->orWhere('no_telp', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10); // Pagination

        // Format respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Distributor berhasil diambil.',
            'data' => $akunDistributor,
        ], 200);
    }
}
