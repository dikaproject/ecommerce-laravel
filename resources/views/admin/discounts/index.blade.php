@extends('layouts.admin')

@section('title', 'Diskon - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Diskon</h1>
        <a href="{{ route('admin.discounts.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Diskon
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="py-3 px-4 text-gray-600">Kode</th>
                    <th class="py-3 px-4 text-gray-600">Tipe</th>
                    <th class="py-3 px-4 text-gray-600">Nilai</th>
                    <th class="py-3 px-4 text-gray-600">Layanan</th>
                    <th class="py-3 px-4 text-gray-600">Periode</th>
                    <th class="py-3 px-4 text-gray-600">Status</th>
                    <th class="py-3 px-4 text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($discounts as $discount)
                <tr>
                    <td class="py-3 px-4 font-semibold">{{ $discount->code }}</td>
                    <td class="py-3 px-4">{{ $discount->discount_type }}</td>
                    <td class="py-3 px-4">
                        @if($discount->discount_type == 'Percentage')
                            {{ $discount->value }}%
                            @if($discount->max_discount)
                                <span class="text-sm text-gray-500">
                                    (Maks: Rp {{ number_format($discount->max_discount, 0, ',', '.') }})
                                </span>
                            @endif
                        @else
                            Rp {{ number_format($discount->value, 0, ',', '.') }}
                        @endif
                    </td>
                    <td class="py-3 px-4">{{ $discount->service ? $discount->service->name : 'Semua Layanan' }}</td>
                    <td class="py-3 px-4">
                        {{ $discount->valid_from->format('d/m/Y') }} - {{ $discount->valid_until->format('d/m/Y') }}
                    </td>
                    <td class="py-3 px-4">
                        @if($discount->isValid())
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Aktif</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ now()->lt($discount->valid_from) ? 'Belum Aktif' : 'Kadaluarsa' }}
                            </span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.discounts.edit', $discount) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus diskon ini?')">
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
                    <td colspan="7" class="py-3 px-4 text-center text-gray-500">Tidak ada data diskon</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $discounts->links() }}
    </div>
</div>
@endsection