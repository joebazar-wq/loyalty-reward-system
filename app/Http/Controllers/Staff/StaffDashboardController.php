<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\PointTransaction;
use App\Models\LoyaltyAccount;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $totalEarned = PointTransaction::where('type', 'earn')->sum('points');
        $totalRedeemed = PointTransaction::where('type', 'redeem')->sum('points');
        $remainingBalances = LoyaltyAccount::sum('points');

        return view('staff.dashboard', compact(
            'totalEarned',
            'totalRedeemed',
            'remainingBalances'
        ));
    }
}
