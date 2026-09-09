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

                    <form action="{{ route('quizzes.store', ['subject' => $subject_id]) }}" method="POST">
                        @csrf

                        <!-- Savol turi (Turkumi) -->
                        <div class="mb-4">
                            <label for="quizType" class="form-label fw-bold">Savol turkumi (turi)</label>
                            <select name="type" id="quizType" class="form-select form-select-lg @error('type') is-invalid @enderror">
                                <option value="single" {{ old('type') == 'single' ? 'selected' : '' }}>
                                    Bitta to'g'ri javobli (Yagona tanlov - Radio)
                                </option>
                                <option value="multiple" {{ old('type') == 'multiple' ? 'selected' : '' }}>
                                    Bir nechta to'g'ri javobli (Ko'p tanlovli - Checkbox)
                                </option>
                            </select>
                            <div class="form-text text-muted">
                                Bir nechta to'g'ri javobli turkum tanlanganda, variantlar oldida bir nechta javobni belgilash imkoni paydo bo'ladi.
                            </div>
                        </div>

                        <!-- Savol matni -->
                        <div class="mb-4">
                            <label for="question" class="form-label fw-bold">Savol matni</label>
                            <textarea name="question" id="question" class="form-control form-control-lg @error('question') is-invalid @enderror" rows="3" placeholder="Savol matnini kiriting..." required>{{ old('question') }}</textarea>
                            @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Variantlar va To'g'ri javob(lar) -->
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-2">Variantlar va To‘g‘ri javob(lar)</label>
                            <div class="alert alert-light border py-2 px-3 small text-muted mb-3" id="typeHint">
                                To'g'ri javob deb hisoblagan variantingiz yonidagi doirachani belgilang.
                            </div>

                            @php
                                $oldCorrect = old('correct');
                                if (!is_array($oldCorrect) && !is_null($oldCorrect)) {
                                    $oldCorrect = [$oldCorrect];
                                }
                                $oldCorrect = $oldCorrect ?? [];
                            @endphp

                            @for($i = 0; $i < 4; $i++)
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-white px-3">
                                        <input type="radio" 
                                               name="correct" 
                                               value="{{ $i }}" 
                                               class="form-check-input correct-input mt-0"
                                               {{ in_array($i, $oldCorrect) ? 'checked' : ($i === 0 && empty($oldCorrect) ? 'checked' : '') }}>
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
                            @error('correct') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                <i class="fas fa-save me-2"></i> Yaratish
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
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('quizType');
    const typeHint = document.getElementById('typeHint');

    function updateInputs() {
        const isMultiple = typeSelect.value === 'multiple';
        const inputs = document.querySelectorAll('.correct-input');

        if (isMultiple) {
            typeHint.innerHTML = '<i class="fas fa-info-circle text-primary me-1"></i> Bir yoki bir nechta to‘g‘ri javobni katakchalardan (checkbox) belgilang.';
            inputs.forEach(input => {
                input.type = 'checkbox';
                input.name = 'correct[]';
            });
        } else {
            typeHint.innerHTML = '<i class="fas fa-info-circle text-primary me-1"></i> To‘g‘ri javob deb hisoblagan bitta variantingiz yonidagi doirachani (radio) belgilang.';
            let checkedFound = false;
            inputs.forEach((input, index) => {
                input.type = 'radio';
                input.name = 'correct';
                if (input.checked && !checkedFound) {
                    checkedFound = true;
                } else if (checkedFound) {
                    input.checked = false;
                }
            });
            if (!checkedFound && inputs.length > 0) {
                inputs[0].checked = true;
            }
        }
    }

    typeSelect.addEventListener('change', updateInputs);
    // Boshlang'ich holatni sozlash (agar old() da multiple bo'lgan bo'lsa)
    updateInputs();
});
</script>
@endsection