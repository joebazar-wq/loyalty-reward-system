<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reward;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $account = $user->loyaltyAccount;

        if (!$account) {
            $totalEarned = 0;
            $totalRedeemed = 0;
            $remainingBalances = 0;
            $redemptions = collect();
            $transactions = collect();
        } else {
            $totalEarned = $account->pointTransactions()
                ->where('type', 'earn')
                ->sum('points');

            $totalRedeemed = $account->pointTransactions()
                ->where('type', 'redeem')
                ->sum('points');

            $remainingBalances = $totalEarned - $totalRedeemed;

            // Redemption history
            $redemptions = $account->pointTransactions()
                ->where('type', 'redeem')
                ->latest()
                ->get();

            // Full transaction history
            $transactions = $account->pointTransactions()
                ->latest()
                ->get();
        }

        // Get all rewards
        $rewards = Reward::all();

        return view('dashboard', compact(
            'rewards',
            'totalEarned',
            'totalRedeemed',
            'remainingBalances',
            'redemptions',
            'transactions'
        ));
    }
}
