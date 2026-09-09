@extends('layouts.admin')

@section('title', 'Yangi fan qo‘shish')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-plus-circle me-2"></i> Yangi fan qo‘shish
                    </h4>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Xatolik yuz berdi:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('subjects.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Fan nomi</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   placeholder="Masalan: Matematika, Ona tili, Fizika..." required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Fan rasmi (muqovasi)</label>
                            <input type="file" id="image" name="image"
                                   class="form-control form-control-lg @error('image') is-invalid @enderror"
                                   accept="image/*" required>
                            <div class="form-text text-muted">Fan uchun mos va sifatli rasm yuklang (JPG, PNG).</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                <i class="fas fa-save me-2"></i> Saqlash
                            </button>
                            <a href="{{ route('subjects.index') }}" class="btn btn-light btn-lg rounded-pill px-4 border">
                                <i class="fas fa-arrow-left me-2"></i> Bekor qilish
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
