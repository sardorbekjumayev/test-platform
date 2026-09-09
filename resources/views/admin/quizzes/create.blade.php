@extends('layouts.admin')

@section('title', 'Savol yaratish')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i> Yangi savol yaratish
                    </h3>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('quizzes.store', ['subject' => $subject_id]) }}" method="POST" id="quizForm">
                        @csrf

                        <!-- Savol turkumi (Tanlash kartalari) -->
                        <div class="mb-4">
                            <label class="form-label fw-bold fs-5 mb-3">Savol turkumi (turini tanlang):</label>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card p-3 h-100 border-2 type-card active" id="cardSingle" style="cursor: pointer; border-color: #4e73df; background-color: #f8faff;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="typeSingle" value="single" checked onchange="handleTypeChange('single')">
                                            <label class="form-check-label fw-bold text-dark fs-6" for="typeSingle" style="cursor: pointer;">
                                                <i class="fas fa-dot-circle text-primary me-2"></i> Yagona tanlovli savol
                                            </label>
                                            <div class="text-muted small mt-1 ps-4">
                                                Faqat bitta to‘g‘ri javob belgilanadi (Radio tugmalar orqali).
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card p-3 h-100 border-2 type-card" id="cardMultiple" style="cursor: pointer; border-color: #e3e6f0; background-color: #ffffff;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="typeMultiple" value="multiple" onchange="handleTypeChange('multiple')">
                                            <label class="form-check-label fw-bold text-dark fs-6" for="typeMultiple" style="cursor: pointer;">
                                                <i class="fas fa-check-square text-purple me-2" style="color: #7c3aed;"></i> Ko‘p tanlovli savol (bir nechta javob)
                                            </label>
                                            <div class="text-muted small mt-1 ps-4">
                                                Bir nechta to‘g‘ri javoblarni tanlash mumkin (Checkbox katakchalar).
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Savol matni -->
                        <div class="mb-4">
                            <label for="question" class="form-label fw-bold">Savol matni</label>
                            <textarea name="question" id="question" class="form-control form-control-lg @error('question') is-invalid @enderror" rows="3" placeholder="Savol matnini kiriting..." required>{{ old('question') }}</textarea>
                            @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Variantlar va To'g'ri javoblar -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Variantlar va To‘g‘ri javob(lar)</label>
                                <span class="badge bg-primary px-3 py-2" id="hintBadge">
                                    <i class="fas fa-info-circle me-1"></i> Bitta to‘g‘ri javobni belgilang
                                </span>
                            </div>

                            @for($i = 0; $i < 4; $i++)
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-white px-3" id="wrapper-{{ $i }}">
                                        <input type="radio" 
                                               name="correct" 
                                               value="{{ $i }}" 
                                               id="input-{{ $i }}"
                                               class="form-check-input mt-0 answer-check-input"
                                               style="transform: scale(1.3); cursor: pointer;"
                                               {{ $i === 0 ? 'checked' : '' }}>
                                    </span>
                                    <input type="text" 
                                           name="options[]" 
                                           class="form-control form-control-lg @error('options.' . $i) is-invalid @enderror" 
                                           value="{{ old('options.' . $i) }}" 
                                           placeholder="Variant #{{ $i + 1 }}" 
                                           required>
                                    @error('options.' . $i) <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                            @endfor
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                <i class="fas fa-save me-2"></i> Saqlash
                            </button>
                            <a href="{{ route('quizzes.index', $subject_id) }}" class="btn btn-secondary btn-lg rounded-pill px-4">
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
function handleTypeChange(type) {
    const isMultiple = (type === 'multiple');
    const cardSingle = document.getElementById('cardSingle');
    const cardMultiple = document.getElementById('cardMultiple');
    const hintBadge = document.getElementById('hintBadge');
    const radioSingle = document.getElementById('typeSingle');
    const radioMultiple = document.getElementById('typeMultiple');

    if (isMultiple) {
        radioMultiple.checked = true;
        cardMultiple.style.borderColor = '#7c3aed';
        cardMultiple.style.backgroundColor = '#f5f3ff';
        cardSingle.style.borderColor = '#e3e6f0';
        cardSingle.style.backgroundColor = '#ffffff';
        hintBadge.className = 'badge px-3 py-2 text-white';
        hintBadge.style.backgroundColor = '#7c3aed';
        hintBadge.innerHTML = '<i class="fas fa-check-double me-1"></i> Bir nechta to‘g‘ri javoblarni katakchalardan belgilang';
    } else {
        radioSingle.checked = true;
        cardSingle.style.borderColor = '#4e73df';
        cardSingle.style.backgroundColor = '#f8faff';
        cardMultiple.style.borderColor = '#e3e6f0';
        cardMultiple.style.backgroundColor = '#ffffff';
        hintBadge.className = 'badge bg-primary px-3 py-2';
        hintBadge.style.backgroundColor = '';
        hintBadge.innerHTML = '<i class="fas fa-info-circle me-1"></i> Bitta to‘g‘ri javobni belgilang';
    }

    // Inputlarni almashtirish
    for (let i = 0; i < 4; i++) {
        const wrapper = document.getElementById('wrapper-' + i);
        const oldInput = document.getElementById('input-' + i);
        const wasChecked = oldInput ? oldInput.checked : (i === 0);

        // Yangi input element yaratamiz
        const newInput = document.createElement('input');
        newInput.id = 'input-' + i;
        newInput.className = 'form-check-input mt-0 answer-check-input';
        newInput.style.transform = 'scale(1.3)';
        newInput.style.cursor = 'pointer';
        newInput.value = i;

        if (isMultiple) {
            newInput.type = 'checkbox';
            newInput.name = 'correct[]';
            newInput.checked = wasChecked;
        } else {
            newInput.type = 'radio';
            newInput.name = 'correct';
            newInput.checked = wasChecked;
        }

        wrapper.innerHTML = '';
        wrapper.appendChild(newInput);
    }
}

// Kartochkalarni bosganda ham ishlashi uchun
document.getElementById('cardSingle').addEventListener('click', function() {
    handleTypeChange('single');
});
document.getElementById('cardMultiple').addEventListener('click', function() {
    handleTypeChange('multiple');
});
</script>
@endsection