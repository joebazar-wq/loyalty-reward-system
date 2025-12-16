<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function store(Request $request, User $user)
    {
        $request->validate(['points'=>'required|integer']);

        $user->increment('points', $request->points);

        PointTransaction::create([
            'user_id' => $user->id,
            'points' => $request->points,
            'type' => 'adjust',
            'source' => 'admin'
        ]);

        return back()->with('success','Points added');
    }

    public function destroy(PointTransaction $transaction)
    {
        $transaction->user->decrement('points', $transaction->points);
        $transaction->delete();

        return back()->with('success','Transaction removed');
    }
}

