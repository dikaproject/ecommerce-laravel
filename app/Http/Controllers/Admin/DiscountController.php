<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Service;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with('service')
            ->latest()
            ->paginate(10);
            
        return view('admin.discounts.index', compact('discounts'));
    }
    
    public function create()
    {
        $services = Service::all();
        return view('admin.discounts.create', compact('services'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:discounts',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:Percentage,Fixed',
            'value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'service_id' => 'nullable|exists:services,id',
        ]);
        
        Discount::create($validated);
        
        return redirect()->route('admin.discounts.index')
            ->with('success', 'Discount created successfully.');
    }
    
    public function edit(Discount $discount)
    {
        $services = Service::all();
        return view('admin.discounts.edit', compact('discount', 'services'));
    }
    
    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:discounts,code,' . $discount->id,
            'description' => 'nullable|string',
            'discount_type' => 'required|in:Percentage,Fixed',
            'value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'service_id' => 'nullable|exists:services,id',
        ]);
        
        $discount->update($validated);
        
        return redirect()->route('admin.discounts.index')
            ->with('success', 'Discount updated successfully.');
    }
    
    public function destroy(Discount $discount)
    {
        $discount->delete();
        
        return redirect()->route('admin.discounts.index')
            ->with('success', 'Discount deleted successfully.');
    }
}