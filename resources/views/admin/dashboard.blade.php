@extends('layouts.admin')

@section('title', 'Bosh sahifa')

@section('content')
<div class="container-fluid px-0">

    <!-- Header & Greetings -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Xush kelibsiz, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-muted mb-0">Platformaning umumiy ko‘rsatkichlari va so‘nggi ma'lumotlari bilan tanishing.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('subjects.create') }}" class="btn btn-primary rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2">
                <i class="fas fa-plus"></i> Yangi fan qo'shish
            </a>
        </div>
    </div>

    <!-- 1-qator: Asosiy statistika kartalari -->
    <div class="row g-3 mb-4">
        <!-- O'quvchilar -->
        <div class="col-xl-3 col-sm-6">
            <div class="card p-3 border-0 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-white text-opacity-75 small text-uppercase fw-bold">O'quvchilar</span>
                        <h2 class="fw-bold my-1">{{ number_format($users) }}</h2>
                        <small class="text-white text-opacity-75"><i class="fas fa-user-graduate me-1"></i> Ro'yxatdan o'tganlar</small>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-4">
                        <i class="fas fa-users fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fanlar -->
        <div class="col-xl-3 col-sm-6">
            <div class="card p-3 border-0 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-white text-opacity-75 small text-uppercase fw-bold">Fanlar soni</span>
                        <h2 class="fw-bold my-1">{{ number_format($subject_count) }}</h2>
                        <small class="text-white text-opacity-75"><i class="fas fa-layer-group me-1"></i> Barcha yo'nalishlar</small>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-4">
                        <i class="fas fa-book-open fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Savollar -->
        <div class="col-xl-3 col-sm-6">
            <div class="card p-3 border-0 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-white text-opacity-75 small text-uppercase fw-bold">Jami savollar</span>
                        <h2 class="fw-bold my-1">{{ number_format($quizzes) }}</h2>
                        <small class="text-white text-opacity-75"><i class="fas fa-check-circle me-1"></i> Test savollari</small>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-4">
                        <i class="fas fa-question fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hujjatlar va Videolar -->
        <div class="col-xl-3 col-sm-6">
            <div class="card p-3 border-0 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #ea580c 0%, #f97316 100%); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-white text-opacity-75 small text-uppercase fw-bold">Materiallar</span>
                        <h2 class="fw-bold my-1">{{ number_format($documents + $videos) }}</h2>
                        <small class="text-white text-opacity-75">{{ $documents }} hujjat • {{ $videos }} video</small>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-4">
                        <i class="fas fa-folder-open fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2-qator: Asosiy fanlar va Tezkor amallar -->
    <div class="row g-4">
        <!-- Eng ko'p materialga ega fanlar -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-trophy text-warning me-2"></i> Eng ko‘p materialga ega fanlar
                    </h5>
                    <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-light rounded-pill px-3">
                        Barchasi <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        @forelse($top_subjects as $subj)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3 border bg-light bg-opacity-50 hover-card">
                                @if($subj->image)
                                    <img src="{{ asset('storage/' . $subj->image) }}" class="rounded-3" width="55" height="55" style="object-fit: cover;">
                                @else
                                    <div class="rounded-3 d-flex align-items-center justify-content-center text-white fw-bold" style="width:55px; height:55px; background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                                        {{ Str::substr($subj->name, 0, 2) }}
                                    </div>
                                @endif
                                <div class="flex-grow-1 overflow-hidden">
                                    <h6 class="mb-1 fw-bold text-dark text-truncate">{{ $subj->name }}</h6>
                                    <div class="d-flex gap-2 small text-muted">
                                        <span><i class="fas fa-file-alt text-warning me-1"></i> {{ $subj->documents_count }} hujjat</span>
                                        <span>•</span>
                                        <span><i class="fas fa-video text-danger me-1"></i> {{ $subj->videos_count ?? 0 }} video</span>
                                    </div>
                                </div>
                                <a href="{{ route('quizzes.index', ['subject' => $subj->id]) }}" class="btn btn-sm btn-outline-primary rounded-circle p-2" title="Savollar">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 py-4 text-center text-muted">
                            Hozircha fanlar kiritilmagan.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Tezkor amallar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-bottom p-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-bolt text-primary me-2"></i> Tezkor havolalar
                    </h5>
                </div>
                <div class="card-body p-3 d-flex flex-column gap-2">
                    <a href="{{ route('subjects.create') }}" class="btn btn-light text-start p-3 rounded-3 border d-flex align-items-center justify-content-between hover-btn">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2 rounded-3 bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-book-medical fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">Yangi fan qo'shish</div>
                                <small class="text-muted">Yangi o'quv fanini tizimga kiritish</small>
                            </div>
                        </div>
                        <i class="fas fa-arrow-right text-muted"></i>
                    </a>

                    <a href="{{ route('admin.results.index') }}" class="btn btn-light text-start p-3 rounded-3 border d-flex align-items-center justify-content-between hover-btn">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2 rounded-3 bg-success bg-opacity-10 text-success">
                                <i class="fas fa-chart-pie fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">Test natijalari</div>
                                <small class="text-muted">Barcha tumanlar va o'quvchilar</small>
                            </div>
                        </div>
                        <i class="fas fa-arrow-right text-muted"></i>
                    </a>

                    <a href="{{ route('admins') }}" class="btn btn-light text-start p-3 rounded-3 border d-flex align-items-center justify-content-between hover-btn">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2 rounded-3 bg-info bg-opacity-10 text-info">
                                <i class="fas fa-user-cog fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">Adminlar boshqaruvi</div>
                                <small class="text-muted">Yangi admin tayinlash yoki ko'rish</small>
                            </div>
                        </div>
                        <i class="fas fa-arrow-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.hover-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.hover-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.06);
    background-color: #ffffff !important;
}
.hover-btn {
    transition: all 0.2s;
}
.hover-btn:hover {
    background-color: #ffffff !important;
    border-color: #4f46e5 !important;
    transform: translateX(4px);
}
</style>
@endsection