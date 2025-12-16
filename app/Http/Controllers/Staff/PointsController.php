<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoyaltyAccount;
use App\Models\PointTransaction;

class PointsController extends Controller
{
    /**
     * Add (earn) points to a user's loyalty account.
     */
    public function store(Request $request)
    {
        $request->validate([
            'loyalty_account_id' => 'required|exists:loyalty_accounts,id',
            'points' => 'required|integer|min:1',
        ]);

        // Create earn transaction
        PointTransaction::create([
            'loyalty_account_id' => $request->loyalty_account_id,
            'type' => 'earn',
            'points' => $request->points,
            'description' => 'Points added by staff'
        ]);

        return redirect()->back()->with('success', 'Points added successfully!');
    }
}
