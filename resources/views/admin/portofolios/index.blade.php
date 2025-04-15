@extends('layouts.admin')

@section('title', 'Portofolio - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Portofolio</h1>
        <a href="{{ route('admin.portofolios.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Portofolio
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="py-3 px-4 text-gray-600">ID</th>
                    <th class="py-3 px-4 text-gray-600">Gambar</th>
                    <th class="py-3 px-4 text-gray-600">Judul</th>
                    <th class="py-3 px-4 text-gray-600">Layanan</th>
                    <th class="py-3 px-4 text-gray-600">Deskripsi</th>
                    <th class="py-3 px-4 text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($portofolios as $portofolio)
                <tr>
                    <td class="py-3 px-4">{{ $portofolio->id }}</td>
                    <td class="py-3 px-4">
                        <img src="{{ asset('storage/' . $portofolio->image_url) }}" alt="{{ $portofolio->title }}" class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="py-3 px-4">{{ $portofolio->title }}</td>
                    <td class="py-3 px-4">{{ $portofolio->service->name }}</td>
                    <td class="py-3 px-4">{{ Str::limit($portofolio->description, 50) }}</td>
                    <td class="py-3 px-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.portofolios.edit', $portofolio) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.portofolios.destroy', $portofolio) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus portofolio ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-3 px-4 text-center text-gray-500">Tidak ada data portofolio</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $portofolios->links() }}
    </div>
</div>
@endsection