@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Yangi fan qo'shish</h3>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Iltimos xatoliklarni tuzating:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Rasm yuklash uchun enctype qo‘shildi --}}
            <form method="POST" action="{{ route('subjects.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Fan nomi</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Matematika, Fizika ..." required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Yangi: Rasm yuklash --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Fan rasmi</label>
                    <input type="file" id="image" name="image"
                           class="form-control @error('image') is-invalid @enderror"
                           accept="image/*" required>

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Bekor qilish</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
