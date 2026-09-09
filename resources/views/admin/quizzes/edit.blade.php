@extends('layouts.admin')
@section('title', 'Savolni tahrirlash')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Savolni tahrirlash — {{ $subject->name }}
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

                    <form action="{{ route('admin.subjects.quizzes.update', [$subject, $quiz]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @php
                            $isMultiple = $quiz->isMultiple();
                            $correctIndexes = $quiz->correct_indexes;
                        @endphp

                        <!-- Savol turkumi (Tanlash kartalari) -->
                        <div class="mb-4">
                            <label class="form-label fw-bold fs-5 mb-3">Savol turkumi (turini tanlang):</label>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card p-3 h-100 border-2 type-card" id="cardSingle" style="cursor: pointer; border-color: {{ !$isMultiple ? '#4e73df' : '#e3e6f0' }}; background-color: {{ !$isMultiple ? '#f8faff' : '#ffffff' }};">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="typeSingle" value="single" {{ !$isMultiple ? 'checked' : '' }} onchange="handleTypeChange('single')">
                                            <label class="form-check-label fw-bold text-dark fs-6" for="typeSingle" style="cursor: pointer;">
                                                <i class="fas fa-dot-circle text-primary me-2"></i> Yagona tanlovli savol
                                            </label>
                                            <div class="text-muted small mt-1 ps-4">
                                                Faqat bitta to‘g‘ri javob belgilanadi (Radio).
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card p-3 h-100 border-2 type-card" id="cardMultiple" style="cursor: pointer; border-color: {{ $isMultiple ? '#7c3aed' : '#e3e6f0' }}; background-color: {{ $isMultiple ? '#f5f3ff' : '#ffffff' }};">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="typeMultiple" value="multiple" {{ $isMultiple ? 'checked' : '' }} onchange="handleTypeChange('multiple')">
                                            <label class="form-check-label fw-bold text-dark fs-6" for="typeMultiple" style="cursor: pointer;">
                                                <i class="fas fa-check-square text-purple me-2" style="color: #7c3aed;"></i> Ko‘p tanlovli savol (bir nechta javob)
                                            </label>
                                            <div class="text-muted small mt-1 ps-4">
                                                Bir nechta to‘g‘ri javoblarni tanlash mumkin (Checkbox).
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Savol matni -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Savol matni</label>
                            <textarea name="question" rows="3"
                                      class="form-control form-control-lg @error('question') is-invalid @enderror"
                                      placeholder="Savolni kiriting..." required>{{ old('question', $quiz->quiz) }}</textarea>
                            @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Variantlar va To'g'ri javoblar -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Variantlar va To‘g‘ri javob(lar)</label>
                                <span class="badge {{ $isMultiple ? 'text-white' : 'bg-primary' }} px-3 py-2" id="hintBadge" style="{{ $isMultiple ? 'background-color: #7c3aed;' : '' }}">
                                    @if($isMultiple)
                                        <i class="fas fa-check-double me-1"></i> Bir nechta to‘g‘ri javoblarni katakchalardan belgilang
                                    @else
                                        <i class="fas fa-info-circle me-1"></i> Bitta to‘g‘ri javobni belgilang
                                    @endif
                                </span>
                            </div>

                            @php
                                $existingOptions = [$quiz->option1, $quiz->option2, $quiz->option3, $quiz->option4];
                            @endphp

                            @for($i = 0; $i < 4; $i++)
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-white px-3" id="wrapper-{{ $i }}">
                                        <input type="{{ $isMultiple ? 'checkbox' : 'radio' }}" 
                                               name="{{ $isMultiple ? 'correct[]' : 'correct' }}" 
                                               value="{{ $i }}"
                                               id="input-{{ $i }}"
                                               class="form-check-input mt-0 answer-check-input"
                                               style="transform: scale(1.3); cursor: pointer;"
                                               {{ in_array($i, $correctIndexes) ? 'checked' : '' }}>
                                    </span>
                                    <input type="text" name="options[]"
                                           class="form-control form-control-lg @error("options.$i") is-invalid @enderror"
                                           value="{{ old("options.$i", $existingOptions[$i] ?? '') }}"
                                           placeholder="Variant #{{ $i + 1 }}" required>
                                    @error("options.$i")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endfor
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                <i class="fas fa-save me-2"></i> Saqlash
                            </button>
                            <a href="{{ route('quizzes.index', $subject->id) }}"
                               class="btn btn-secondary btn-lg rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i> Orqaga
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

    for (let i = 0; i < 4; i++) {
        const wrapper = document.getElementById('wrapper-' + i);
        const oldInput = document.getElementById('input-' + i);
        const wasChecked = oldInput ? oldInput.checked : false;

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

document.getElementById('cardSingle').addEventListener('click', function() {
    handleTypeChange('single');
});
document.getElementById('cardMultiple').addEventListener('click', function() {
    handleTypeChange('multiple');
});
</script>
@endsection