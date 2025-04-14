<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use App\Models\Service;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::with('service')->latest()->paginate(12);
        return view('user.portofolios.index', compact('portofolios'));
    }
    
    public function show(Portofolio $portofolio)
    {
        $portofolio->load('service');
        $relatedPortfolios = Portofolio::where('service_id', $portofolio->service_id)
            ->where('id', '!=', $portofolio->id)
            ->take(4)
            ->get();
            
        return view('user.portofolios.show', compact('portofolio', 'relatedPortfolios'));
    }
    
    public function byService(Service $service)
    {
        $portofolios = $service->portofolios()->latest()->paginate(12);
        return view('user.portofolios.by-service', compact('portofolios', 'service'));
    }
}