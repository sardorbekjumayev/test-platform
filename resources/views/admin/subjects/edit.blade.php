@extends('layouts.admin')

@section('title', 'Fan tahrirlash — ' . $subject->name)

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h3 class="mb-0 d-flex align-items-center gap-3">
                <i class="fas fa-edit"></i>
                Fan ma'lumotlarini tahrirlash
            </h3>
        </div>

        <div class="card-body p-4">

            <!-- Muvaffaqiyat xabari -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Xatoliklar -->
            @if($errors->any())
                <div class="alert alert-danger rounded-4 shadow-ssm">
                    <strong>Iltimos quyidagi xatoliklarni tuzating:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tahrirlash formasi -->
            <form method="POST" action="{{ route('subjects.update', $subject->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Fan nomi -->
                    <div class="col-lg-8">
                        <label for="name" class="form-label fw-bold">Fan nomi</label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $subject->name) }}"
                               class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                               placeholder="Masalan: Matematika"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Rasm yuklash -->
                    <div class="col-lg-8">
                        <label for="image" class="form-label fw-bold">Fan rasmi (yangisini tanlang)</label>
                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control form-control-lg rounded-3 @error('image') is-invalid @enderror"
                               accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">
                            <i class="fas fa-info-circle"></i>
                            Agar rasmni o‘zgartirmoqchi bo‘lmasangiz, bo‘sh qoldiring
                        </div>
                    </div>

                    <!-- Joriy rasmni ko‘rsatish + oldindan ko‘rish -->
                    <div class="col-lg-8">
                        <div class="row g-3">
                            <!-- Joriy rasm -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted">Joriy rasm</label>
                                <div class="border rounded-3 overflow-hidden shadow-sm">
                                    <img src="{{ $subject->image ? asset('storage/' . $subject->image) : asset('images/default-subject.jpg') }}"
                                         alt="{{ $subject->name }}"
                                         class="img-fluid"
                                         style="height: 180px; width: 100%; object-fit: cover;">
                                </div>
                            </div>

                            <!-- Yangi rasm oldindan ko‘rish -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted">Yangi rasm (oldindan ko‘rish)</label>
                                <div class="border rounded-3 overflow-hidden shadow-sm bg-light d-flex align-items-center justify-content-center"
                                     style="height: 180px;">
                                    <img id="imagePreview"
                                         src=""
                                         alt="Yangi rasm"
                                         class="img-fluid d-none"
                                         style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                    <div id="placeholderText" class="text-muted">
                                        <i class="fas fa-image fa-3x mb-2"></i><br>
                                        Rasm tanlanmagan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tugmalar -->
                <div class="d-flex gap-3 mt-5">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                        <i class="fas fa-save me-2"></i> Saqlash
                    </button>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-lg rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i> Orqaga
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Rasm oldindan ko‘rish uchun JS -->

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