<?php

namespace App\Services;

use App\Models\LoyaltyAccount;
use App\Models\PointTransaction;

class PointsService
{
    public static function getBalances($userId)
    {
        $loyaltyAccount = LoyaltyAccount::where('user_id', $userId)->first();

        $totalEarned = 0;
        $totalRedeemed = 0;
        $remainingBalances = 0;

        if ($loyaltyAccount) {
            $totalEarned = PointTransaction::where('loyalty_account_id', $loyaltyAccount->id)
                ->where('type', 'earn')
                ->sum('points');

            $totalRedeemed = PointTransaction::where('loyalty_account_id', $loyaltyAccount->id)
                ->where('type', 'redeem')
                ->sum('points');

            $remainingBalances = $totalEarned - $totalRedeemed;
        }

        return compact('totalEarned', 'totalRedeemed', 'remainingBalances');
    }
}
// class PointService
// {
//     public function add(User $user, int $points, string $reason)
//     {
//         $user->loyaltyAccount->increment('balance', $points);

//         PointTransaction::create([
//             'user_id' => $user->id,
//             'points' => $points,
//             'type' => 'earn',
//             'description' => $reason,
//         ]);
//     }

//     public function deduct(User $user, int $points, string $reason)
//     {
//         if ($user->loyaltyAccount->balance < $points) {
//             throw new \Exception('Not enough points');
//         }

//         $user->loyaltyAccount->decrement('balance', $points);

//         PointTransaction::create([
//             'user_id' => $user->id,
//             'points' => -$points,
//             'type' => 'redeem',
//             'description' => $reason,
//         ]);
//     }
// }
