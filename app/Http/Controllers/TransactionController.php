<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\WasteCategory;
use App\Models\TransactionWaste;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Customer Dashboard
    public function customerDashboard() {
        $transactions = Transaction::where('customer_id', Auth::id())->with('wastes')->get();
        return view('customer.dashboard', compact('transactions'));
    }

    public function requestPickup() {
        Transaction::create([
            'customer_id' => Auth::id(),
            'status' => 'pending',
            'total_points' => 0
        ]);
        return back()->with('success', 'Request penjemputan berhasil dibuat.');
    }

    // Merchant Dashboard
    public function merchantDashboard() {
        $pendingRequests = Transaction::where('status', 'pending')->with('customer')->get();
        $myTasks = Transaction::where('merchant_id', Auth::id())->where('status', 'accepted')->with('customer')->get();
        return view('merchant.dashboard', compact('pendingRequests', 'myTasks'));
    }

    public function acceptPickup($id) {
        $transaction = Transaction::where('status', 'pending')->findOrFail($id);
        $transaction->merchant_id = Auth::id();
        $transaction->status = 'accepted';
        $transaction->save();
        return back()->with('success', 'Tugas penjemputan diterima.');
    }

    public function showWeighingForm($id) {
        $transaction = Transaction::where('merchant_id', Auth::id())->where('status', 'accepted')->findOrFail($id);
        $categories = WasteCategory::all();
        return view('merchant.weighing', compact('transaction', 'categories'));
    }

    public function storeWeighing(Request $request, $id) {
        $request->validate([
            'wastes' => 'required|array|min:1',
            'wastes.*.waste_category_id' => 'required|exists:waste_categories,id',
            'wastes.*.weight_kg' => 'required|numeric|min:0.1'
        ]);

        $transaction = Transaction::where('merchant_id', Auth::id())->where('status', 'accepted')->findOrFail($id);
        
        $totalPoints = 0;
        foreach ($request->wastes as $wasteData) {
            $category = WasteCategory::find($wasteData['waste_category_id']);
            $points = $wasteData['weight_kg'] * $category->point_per_kg;
            $totalPoints += $points;

            TransactionWaste::create([
                'transaction_id' => $transaction->id,
                'waste_category_id' => $category->id,
                'weight_kg' => $wasteData['weight_kg']
            ]);
        }

        $transaction->total_points = $totalPoints;
        $transaction->status = 'completed';
        $transaction->save();

        $customer = User::find($transaction->customer_id);
        $customer->point_balance += $totalPoints;
        $customer->save();

        return redirect()->route('merchant.dashboard')->with('success', 'Transaksi selesai. Saldo poin warga telah diperbarui.');
    }
}
