<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * CUSTOMER: Place an order
     */
    public function placeOrder(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'item_name' => 'required|string',
            'quantity'  => 'required|integer|min:1',
            'price'     => 'required|numeric|min:1',
            'payment_method' => 'nullable|string|in:cod,credit_card',
        ]);

        $totalAmount = $validated['price'] * $validated['quantity'];

        // Calculate points earned
        $pointsEarned = floor($totalAmount / 100);

        // Save order with points earned
        $order = Order::create([
            'user_id'        => $user->id,
            'item_name'      => $validated['item_name'],
            'quantity'       => $validated['quantity'],
            'price'          => $validated['price'],
            'total_amount'   => $totalAmount,
            'status'         => 'pending',
            'payment_method' => $validated['payment_method'] ?? null,
            'points_earned'  => $pointsEarned,
        ]);

        // Add points to user
        if ($pointsEarned > 0) {
            $user->points += $pointsEarned;
            $user->save();

            PointTransaction::create([
                'user_id'     => $user->id,
                'type'        => 'earn',
                'points'      => $pointsEarned,
                'description' => "Earned {$pointsEarned} points for Order #{$order->id}",
            ]);
        }

        return back()->with('success', 'Order placed successfully!');
    }

    /**
     * CUSTOMER: View their own orders
     */
public function customerOrders()
{
    // $orders = Order::where('user_id', auth()->id())
    //     ->latest()
    //     ->get();
$orders = Order::all();
    return view('orders.customer-orders', compact('orders'));
}

    /**
     * STAFF/ADMIN: View ALL orders
     */
public function index()
{
    $orders = Order::latest()->get();

    return view('orders.admin-orders', compact('orders'));
}


    /**
     * ADMIN: Admin order management page
     */
public function admin()
{
    $orders = Order::latest()->get();

    return view('orders.admin-orders', compact('orders'));
}


    /**
     * CUSTOMER: Cancel Order
     */
    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be canceled.');
        }

        // Deduct points if any
        if ($order->points_earned > 0) {
            $user = Auth::user();
            $user->points -= $order->points_earned;
            $user->save();

            PointTransaction::create([
                'user_id' => $user->id,
                'type' => 'deduct',
                'points' => $order->points_earned,
                'description' => "Deducted points for canceled Order #{$order->id}",
            ]);
        }

        $order->update(['status' => 'canceled']);

        return back()->with('success', 'Order canceled successfully.');
    }

    /**
     * ADMIN: Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,completed,canceled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated.');
    }

    /**
     * STAFF/ADMIN: View pending orders
     */
    public function pending()
    {
        $orders = Order::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.pending', compact('orders'));
    }
}
