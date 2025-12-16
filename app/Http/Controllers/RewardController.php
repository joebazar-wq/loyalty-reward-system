<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('rewards.index', [
            'points' => $user->points,
            'rewards' => Reward::where('status', 'active')->get(),
            'transactions' => $user->transactions()->latest()->get(),
        ]);
    }

    public function redeem(Request $request, Reward $reward)
    {
        $user = Auth::user();

        if ($user->points < $reward->points_required) {
            return back()->with('error', 'Not enough points.');
        }

        // subtract points
        $user->points -= $reward->points_required;
        $user->save();

        // create transaction
        PointTransaction::create([
            'user_id' => $user->id,
            'type' => 'redeem',
            'points' => $reward->points_required,
            'description' => 'Redeemed reward: ' . $reward->description,
        ]);

        return back()->with('success', 'Reward redeemed successfully!');
    }

    public function history()
    {
        $transactions = Auth::user()
            ->transactions()
            ->latest()
            ->get();

        return view('rewards.history', compact('transactions'));
    }
}
