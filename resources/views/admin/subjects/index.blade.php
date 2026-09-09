@extends('layouts.admin')

@section('title', 'Fanlar')

@section('content')
<div class="container-fluid px-0">

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">O'quv fanlari</h3>
            <p class="text-muted small mb-0">Platformadagi barcha fanlar ro'yxati va ularga oid materiallar</p>
        </div>
        <a href="{{ route('subjects.create') }}" class="btn btn-primary rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2">
            <i class="fas fa-plus"></i> Yangi fan qo'shish
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Fan rasmi & Nomi</th>
                        <th>Materiallar</th>
                        <th class="text-end" style="width: 280px;">Boshqaruv</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects ?? [] as $subject)
                        <tr>
                            <td class="text-muted fw-semibold">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if($subject->image)
                                        <img src="{{ asset('storage/' . $subject->image) }}" class="rounded-3 shadow-sm" width="48" height="48" style="object-fit: cover;">
                                    @else
                                        <div class="rounded-3 d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                                            {{ Str::substr($subject->name, 0, 2) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold text-dark fs-6">{{ $subject->name }}</div>
                                        <small class="text-muted">ID: #{{ $subject->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('quizzes.index', ['subject' => $subject->id]) }}" class="badge bg-purple-subtle text-purple text-decoration-none px-3 py-2 rounded-pill" style="background-color: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe;">
                                        <i class="fas fa-question-circle me-1"></i> Savollar
                                    </a>
                                    <a href="{{ route('document.index', ['subject' => $subject->id]) }}" class="badge bg-warning-subtle text-warning text-decoration-none px-3 py-2 rounded-pill" style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                                        <i class="fas fa-file-alt me-1"></i> Hujjatlar
                                    </a>
                                    <a href="{{ route('video.index', ['subject' => $subject->id]) }}" class="badge bg-danger-subtle text-danger text-decoration-none px-3 py-2 rounded-pill" style="background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca;">
                                        <i class="fas fa-video me-1"></i> Videolar
                                    </a>
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-light border rounded-pill px-3">
                                        <i class="fas fa-edit me-1 text-primary"></i> Tahrirlash
                                    </a>

                                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline" onsubmit="return confirm('Haqiqatan ham {{ $subject->name }} fanini o‘chirmoqchimisiz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="fas fa-trash me-1"></i> O‘chirish
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-book-open fa-3x mb-3 opacity-25"></i>
                                <h6>Fanlar mavjud emas</h6>
                                <p class="small mb-3">Hozircha birorta ham fan qo'shilmagan.</p>
                                <a href="{{ route('subjects.create') }}" class="btn btn-sm btn-primary rounded-pill px-3">Yangi fan qo'shish</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(isset($subjects) && method_exists($subjects, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $subjects->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
