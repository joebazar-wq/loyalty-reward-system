<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointTransaction;
use App\Models\LoyaltyAccount;

class ReportController extends Controller
{
    public function index()
    {
        $totalEarned = PointTransaction::where('type', 'earn')->sum('points');

        $totalRedeemed = PointTransaction::where('type', 'redeem')->sum('points');

        $remainingBalances = LoyaltyAccount::sum('points');

        return view('admin.reports', compact(
            'totalEarned',
            'totalRedeemed',
            'remainingBalances'
        ));
    }
}
