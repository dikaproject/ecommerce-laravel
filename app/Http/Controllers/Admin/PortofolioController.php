<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::with('service')->latest()->paginate(10);
        return view('admin.portofolios.index', compact('portofolios'));
    }
    
    public function create()
    {
        $services = Service::all();
        return view('admin.portofolios.create', compact('services'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'service_id' => 'required|exists:services,id',
        ]);
        
        $path = $request->file('image')->store('portofolios', 'public');
        
        Portofolio::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_url' => $path,
            'service_id' => $validated['service_id'],
        ]);
        
        return redirect()->route('admin.portofolios.index')
            ->with('success', 'Portfolio created successfully.');
    }
    
    public function edit(Portofolio $portofolio)
    {
        $services = Service::all();
        return view('admin.portofolios.edit', compact('portofolio', 'services'));
    }
    
    public function update(Request $request, Portofolio $portofolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'service_id' => 'required|exists:services,id',
        ]);
        
        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'service_id' => $validated['service_id'],
        ];
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($portofolio->image_url) {
                Storage::disk('public')->delete($portofolio->image_url);
            }
            
            $path = $request->file('image')->store('portofolios', 'public');
            $data['image_url'] = $path;
        }
        
        $portofolio->update($data);
        
        return redirect()->route('admin.portofolios.index')
            ->with('success', 'Portfolio updated successfully.');
    }
    
    public function destroy(Portofolio $portofolio)
    {
        // Delete image file
        if ($portofolio->image_url) {
            Storage::disk('public')->delete($portofolio->image_url);
        }
        
        $portofolio->delete();
        
        return redirect()->route('admin.portofolios.index')
            ->with('success', 'Portfolio deleted successfully.');
    }
}