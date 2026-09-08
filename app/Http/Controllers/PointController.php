<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function viewHistory() {
        $user = Auth::user();
        // Asumsi menampilkan log penambahan dari transaksi
        $transactions = \App\Models\Transaction::where('customer_id', $user->id)
                            ->where('status', 'completed')
                            ->orderBy('updated_at', 'desc')
                            ->get();
        return view('customer.point_history', compact('user', 'transactions'));
    }

    public function redeemPoints(Request $request) {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $user = Auth::user();
        
        if ($user->point_balance < $request->amount) {
            return back()->with('error', 'Saldo poin tidak mencukupi.');
        }

        $user->decrement('point_balance', $request->amount);

        return back()->with('success', "Poin sebesar {$request->amount} berhasil ditukar.");
    }
}
