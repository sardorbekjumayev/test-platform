@extends('layouts.admin')
@section('title', 'Savolni tahrirlash')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Savolni tahrirlash — {{ $subject->name }}
                    </h3>
                </div>

                <div class="card-body p-5">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.subjects.quizzes.update', [$subject, $quiz]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-bold">Savol matni</label>
                            <textarea name="question" rows="4"
                                      class="form-control form-control-lg @error('question') is-invalid @enderror"
                                      placeholder="Savolni kiriting..." required>{{ old('question', $quiz->question) }}</textarea>
                            @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3">Javob variantlari</label>

                            @php
                                // Agar old() bo‘lsa → undan, aks holda bazadagi JSON ni array qilamiz
                                $options = old('options') ?? ($quiz->options ? json_decode($quiz->options, true) : array_fill(0, 4, ''));
                                $correct = old('correct') ?? $quiz->correct_answer;
                            @endphp

                            @for($i = 0; $i < 4; $i++)
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-white">
                                        <input type="radio" name="correct" value="{{ $i }}"
                                               class="form-check-input mt-0"
                                               {{ $correct == $i ? 'checked' : '' }}>
                                    </span>
                                    <input type="text" name="options[]"
                                           class="form-control form-control-lg @error("options.$i") is-invalid @enderror"
                                           value="{{ $options[$i] ?? '' }}"
                                           placeholder="Javob #{{ $i + 1 }}" required>
                                    @error("options.$i")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endfor

                            @error('correct')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                <i class="fas fa-save me-2"></i> Saqlash
                            </button>
                            <a href="{{ route('quizzes.index', $subject) }}"
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
@endsection