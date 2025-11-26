@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">{{ $quiz->subject->name }} — Test</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('tests.submit', $instance->id) }}" method="POST">
                @csrf

                @foreach($questions as $index => $question)
                    <div class="mb-4">
                        <h5>{{ $index + 1 }}. {{ $question->question_text }}</h5>

                        @foreach($question->options as $option)
                            <div class="form-check mt-1">
                                <input class="form-check-input"
                                       type="radio"
                                       name="answers[{{ $question->id }}]"
                                       value="{{ $option['key'] }}">
                                <label class="form-check-label">
                                    {{ $option['text'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <hr>
                @endforeach

                <button class="btn btn-primary">Testni yakunlash</button>
            </form>

        </div>
    </div>
</div>
@endsection
