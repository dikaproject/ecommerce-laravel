<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_services' => Service::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'Pending')->count(),
            'paid_orders' => Order::where('status', 'Paid')->count(),
            'completed_orders' => Order::where('status', 'Completed')->count(),
            'revenue' => Order::where('status', 'Paid')->orWhere('status', 'Completed')->sum('total_price_after_discount'),
        ];
        
        $recent_orders = Order::with(['user', 'service'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return view('admin.dashboard', compact('stats', 'recent_orders'));
    }
}