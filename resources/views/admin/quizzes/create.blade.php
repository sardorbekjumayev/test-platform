@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Savol yaratish</h2>

    <form action="{{ route('quizzes.store', ['subject'=>$subject_id]) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="question" class="form-label">Savol</label>
            <textarea name="question" id="question" class="form-control @error('question') is-invalid @enderror" rows="3">{{ old('question') }}</textarea>
            @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Javoblar</label>
            @for($i = 0; $i < 4; $i++)
                <div class="input-group mb-2">
                    <span class="input-group-text">
                        <input type="radio" name="correct" value="{{ $i }}" {{ old('correct') == $i ? 'checked' : '' }}>
                    </span>
                    <input type="text" name="options[]" class="form-control @error('options.' . $i) is-invalid @enderror" value="{{ old('options.' . $i) }}" placeholder="Javob #{{ $i + 1 }}">
                    @error('options.' . $i) <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
            @endfor
            @error('correct') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>


        <button type="submit" class="btn btn-primary">Yaratish</button>
        <a href="" class="btn btn-secondary ms-2">Bekor qilish</a>
    </form>
</div>
@endsection