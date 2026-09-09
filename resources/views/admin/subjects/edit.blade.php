@extends('layouts.admin')

@section('title', 'Fan tahrirlash — ' . $subject->name)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-edit me-2"></i> {{ $subject->name }} — tahrirlash
                    </h4>
                </div>

                <div class="card-body p-4 p-md-5">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4">
                            <strong>Iltimos quyidagi xatoliklarni tuzating:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('subjects.update', $subject->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Fan nomi</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $subject->name) }}"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   placeholder="Masalan: Matematika"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Fan rasmi</label>
                            <input type="file"
                                   id="image"
                                   name="image"
                                   class="form-control form-control-lg @error('image') is-invalid @enderror"
                                   accept="image/*">
                            <div class="form-text text-muted">
                                Agar yangi rasm yuklamoqchi bo‘lmasangiz, bo‘sh qoldiring.
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Rasmlar ko'rinishi -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Joriy rasm</label>
                                <div class="border rounded-3 overflow-hidden bg-light" style="height: 180px;">
                                    <img src="{{ $subject->image ? asset('storage/' . $subject->image) : asset('images/default-subject.jpg') }}"
                                         alt="{{ $subject->name }}"
                                         class="w-100 h-100"
                                         style="object-fit: cover;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Yangi rasm (oldindan ko‘rish)</label>
                                <div class="border rounded-3 overflow-hidden bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <img id="imagePreview"
                                         src=""
                                         alt="Yangi rasm"
                                         class="img-fluid d-none h-100 w-100"
                                         style="object-fit: cover;">
                                    <div id="placeholderText" class="text-muted text-center p-3">
                                        <i class="fas fa-image fa-2x mb-2 opacity-50"></i><br>
                                        <small>Yangi rasm tanlanmagan</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-4">
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

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('placeholderText');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('d-none');
            placeholder.classList.remove('d-none');
        }
    });
</script>
@endsection