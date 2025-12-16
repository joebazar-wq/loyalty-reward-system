<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedemptionController extends Controller
{
    // USER redeems reward
    public function store(Reward $reward)
    {
        $user = auth()->user();

        if ($user->points < $reward->points_required) {
            return back()->with('error','Not enough points');
        }

        $user->decrement('points', $reward->points_required);

        PointTransaction::create([
            'user_id' => $user->id,
            'points' => -$reward->points_required,
            'type' => 'redeem',
            'source' => 'reward'
        ]);

        Redemption::create([
            'user_id' => $user->id,
            'reward_id' => $reward->id
        ]);

        return back()->with('success','Reward redeemed');
    }

    // ADMIN approves
    public function approve(Redemption $redemption)
    {
        $redemption->update([
            'status' => 'approved',
            'redeemed_at' => now()
        ]);

        return back()->with('success','Redemption approved');
    }

    public function reject(Redemption $redemption)
    {
        $user = $redemption->user;
        $reward = $redemption->reward;

        // refund points
        $user->increment('points', $reward->points_required);

        PointTransaction::create([
            'user_id' => $user->id,
            'points' => $reward->points_required,
            'type' => 'adjust',
            'source' => 'refund'
        ]);

        $redemption->update(['status'=>'rejected']);

        return back()->with('success','Redemption rejected');
    }
}
