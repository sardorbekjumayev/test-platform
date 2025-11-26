@extends('layouts.admin')
@section('title', 'Adminlar boshqaruvi')

@section('content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-bold text-primary">
        Adminlar boshqaruvi
    </h2>

    <!-- 1. YANGI ADMIN QO‘SHISH FORMASI -->
    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Yangi admin qo‘shish (User ID orqali)</h5>
        </div>
        <div class="card-body">

            <!-- Muvaffaqiyat / Xato xabarlari -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('make-admin') }}" class="row g-3 align-items-end">
                @csrf
                <div class="col-md-6 col-lg-4">
                    <label class="form-label fw-bold">Foydalanuvchi ID si</label>
                    <input type="number" name="user_id" class="form-control form-control-lg" 
                           value="{{ old('user_id') }}" placeholder="Masalan: 123" required min="1">
                    @error('user_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 col-lg-3">
                    <button type="submit" class="btn btn-success btn-lg w-100">
                        Admin qilish
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. MAVJUD ADMINLAR RO‘YXATI -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-light">
            <h5 class="mb-0 fw-bold">
                Mavjud adminlar ({{ $admins->count() }} ta)
            </h5>
        </div>
        <div class="card-body p-0">
            @if($admins->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Foydalanuvchi</th>
                                <th>Email</th>
                                <th>Ro‘yxatdan o‘tgan</th>
                                <th class="text-end">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
                                    <td>{{ $admin->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                                                 style="width:40px;height:40px;">
                                                {{ Str::substr($admin->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $admin->name }}</div>
                                                @if($admin->id === auth()->id())
                                                    <small class="badge bg-primary">Siz</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->created_at->format('d.m.Y') }}</td>
                                    <td class="text-end">
                                        @if($admin->id !== auth()->id())
                                            <form method="POST" action="{{ route('remove-admin', $admin->id) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill"
                                                        onclick="return confirm('{{ $admin->name }} ni adminlikdan chiqarasizmi?')">
                                                    Adminlikni olib tashlash
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small">O‘chirib bo‘lmaydi</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-users-slash fa-4x mb-3"></i>
                    <h5>Hozircha admin yo‘q</h5>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection