@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Savollar ro'yxati</h1>
            <small class="text-muted">{{ $subject->name ?? 'Fan' }} bo'yicha test savollari</small>
        </div>
        <a href="{{ route('quizzes.create', ['subject' => $id]) }}" class="btn btn-primary rounded-pill px-4">
            <i class="fas fa-plus me-1"></i> Yangi savol yaratish
        </a>
    </div>   

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Savol</th>
                        <th>Turi</th>
                        <th>Variant 1</th>
                        <th>Variant 2</th>
                        <th>Variant 3</th>
                        <th>Variant 4</th>
                        <th>To`g`ri Javob(lar)</th>
                        <th class="text-end" style="width: 180px;">Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quizzes as $quiz)
                        <tr>
                            <td>{{ $loop->iteration + ( ($quizzes->currentPage()-1) * $quizzes->perPage() ) }}</td>
                            <td>
                                <strong>{{ Str::limit($quiz->quiz, 80) }}</strong>
                            </td>
                            <td>
                                @if($quiz->isMultiple())
                                    <span class="badge bg-purple text-white" style="background-color: #7c3aed;">
                                        <i class="fas fa-check-double me-1"></i> Ko'p tanlovli
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-check me-1"></i> Yagona
                                    </span>
                                @endif
                            </td>
                            <td>{{ $quiz->option1 ?? '-' }}</td>
                            <td>{{ $quiz->option2 ?? '-' }}</td>
                            <td>{{ $quiz->option3 ?? '-' }}</td>
                            <td>{{ $quiz->option4 ?? '-' }}</td>
                            <td>
                                @php
                                    $answers = $quiz->correct_answers;
                                @endphp
                                @if(!empty($answers))
                                    @foreach($answers as $ans)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle mb-1">
                                            {{ $ans }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.quizzes.edit', ['quiz' => $quiz->id, 'subject' => $id]) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="fas fa-edit me-1"></i> Tahrirlash
                                </a>

                                <form action="{{ route('admin.quizzes.delete', $quiz->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Haqiqatan ham bu savolni o‘chirmoqchimisiz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="fas fa-trash me-1"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">Savollar mavjud emas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            @if(method_exists($quizzes, 'total'))
                <small class="text-muted">Ko'rsatilyapti: {{ $quizzes->firstItem() ?? 0 }} - {{ $quizzes->lastItem() ?? 0 }} (Jami: {{ $quizzes->total() }} ta savol)</small>
            @endif
        </div>
        <div>
            {{ $quizzes->links('pagination::bootstrap-5') ?? '' }}
        </div>
    </div>
</div>
@endsection