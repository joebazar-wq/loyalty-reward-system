<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;

class AdminRewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::all(); // Get all rewards
        return view('admin.points', compact('rewards'));
    }

    public function create()
    {
        return view('admin.rewards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points_required' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        Reward::create($request->all());

        return redirect()->route('admin.rewards')->with('success', 'Reward created successfully.');
    }

    public function edit(Reward $reward)
    {
        return view('admin.rewards.edit', compact('reward'));
    }

    public function update(Request $request, Reward $reward)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points_required' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $reward->update($request->all());

        return redirect()->route('admin.rewards')->with('success', 'Reward updated successfully.');
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();
        return redirect()->route('admin.rewards')->with('success', 'Reward deleted successfully.');
    }
}
