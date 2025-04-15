@extends('layouts.admin')

@section('title', 'Pengguna - Admin DesignArt Studio')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Pengguna</h1>
        <a href="{{ route('admin.users.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Pengguna
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="py-3 px-4 text-gray-600">ID</th>
                    <th class="py-3 px-4 text-gray-600">Nama</th>
                    <th class="py-3 px-4 text-gray-600">Email</th>
                    <th class="py-3 px-4 text-gray-600">Role</th>
                    <th class="py-3 px-4 text-gray-600">Telepon</th>
                    <th class="py-3 px-4 text-gray-600">Tanggal Daftar</th>
                    <th class="py-3 px-4 text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                <tr>
                    <td class="py-3 px-4">{{ $user->id }}</td>
                    <td class="py-3 px-4">{{ $user->name }}</td>
                    <td class="py-3 px-4">{{ $user->email }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 text-xs {{ $user->role == 'admin' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800' }} rounded-full">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="py-3 px-4">{{ $user->phone ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="py-3 px-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-3 px-4 text-center text-gray-500">Tidak ada data pengguna</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection