<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('user.services.index', compact('services'));
    }
    
    public function show(Service $service)
    {
        $service->load('portofolios');
        return view('user.services.show', compact('service'));
    }
    
    public function order(Service $service)
    {
        return view('user.orders.create', compact('service'));
    }
}