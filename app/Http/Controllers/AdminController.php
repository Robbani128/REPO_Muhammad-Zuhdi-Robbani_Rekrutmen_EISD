<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WasteCategory;
use App\Models\TransactionWaste;

class AdminController extends Controller
{
    public function dashboard() {
        $pendingMerchants = User::where('role', 'merchant')->where('status', 'pending')->get();
        return view('admin.dashboard', compact('pendingMerchants'));
    }

    public function validateMerchant($id) {
        $merchant = User::where('role', 'merchant')->findOrFail($id);
        $merchant->status = 'approved';
        $merchant->save();
        return back()->with('success', 'Akun pengepul berhasil divalidasi.');
    }

    public function manageWasteCategories() {
        $categories = WasteCategory::all();
        return view('admin.categories', compact('categories'));
    }

    public function storeWasteCategory(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'point_per_kg' => 'required|numeric|min:0'
        ]);
        WasteCategory::create($request->all());
        return back()->with('success', 'Kategori sampah berhasil ditambahkan.');
    }

    public function viewReport() {
        $totalTonase = TransactionWaste::sum('weight_kg');
        return view('admin.report', compact('totalTonase'));
    }
}
