<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PointTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get the user's loyalty account (adjust if your relationship differs)
        $account = $user->loyaltyAccount; // Make sure you have a `loyaltyAccount()` relation

        // Total earned and redeemed points
        $totalEarned = $account->pointTransactions()->where('type', 'earn')->sum('points');
        $totalRedeemed = $account->pointTransactions()->where('type', 'redeem')->sum('points');

        // Remaining balance
        $remainingBalances = $totalEarned - $totalRedeemed;

        // Fetch all transactions
        $transactions = $account->pointTransactions()->latest()->get();

        return view('dashboard', compact(
            'account',
            'totalEarned',
            'totalRedeemed',
            'remainingBalances',
            'transactions'
        ));
    }
}

