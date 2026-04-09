@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="hero-section">
    <h1>Admin Dashboard</h1>
    <p>Kelola e-commerce platform Anda</p>
</div>

<!-- Quick Links -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
    <a href="{{ route('admin.products.index') }}" style="background-color: var(--color-tangelo); color: var(--color-brown); padding: 1.5rem; border-radius: 8px; text-decoration: none; text-align: center; font-weight: bold; transition: all 0.3s ease; cursor: pointer;">
        Kelola Produk
    </a>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3>{{ $totalProducts }}</h3>
        <p>Total Produk</p>
    </div>

    <div class="stat-card">
        <h3>{{ $totalCategories }}</h3>
        <p>Total Kategori</p>
    </div>

    <div class="stat-card">
        <h3>{{ $totalUsers }}</h3>
        <p>Total Pengguna</p>
    </div>
</div>

<div class="table-container">
    <h2>Daftar Produk Terbaru</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse (\App\Models\product::latest()->take(5)->get() as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                        @else
                            <span style="color: #999;">Tidak ada foto</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <div class="category-tags">
                            @foreach ($product->categories as $category)
                                <span class="category-tag">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" style="color: var(--color-tangelo); text-decoration: none; font-weight: bold;">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-state">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="table-container">
    <h2>Daftar Pengguna</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse (\App\Models\User::all() as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="role-badge {{ $user->role === 'admin' ? 'admin' : 'user' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty-state">Belum ada pengguna.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
