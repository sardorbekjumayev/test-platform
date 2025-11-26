@extends('layouts.admin')

@section('title', 'Admin Panel')

@section('content')
<div class="container-fluid py-4">

    <h2 class="mb-1 fw-bold text-dark">Admin Panel</h2>
    <p class="text-muted mb-4">Tizimning umumiy holati • {{ now()->format('d.m.Y, H:i') }}</p>

    <!-- 1-qator: Asosiy statistika -->
    <div class="row g-4 mb-5">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 bg-gradient-primary text-white">
                <i class="fas fa-users fa-3x mb-3 opacity-75"></i>
                <h3 class="mb-0">{{ number_format($users) }}</h3>
                <p class="mb-0 opacity-90">Jami o‘quvchilar</p>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 bg-gradient-success text-white">
                <i class="fas fa-book-open fa-3x mb-3 opacity-75"></i>
                <h3 class="mb-0">{{ number_format($subject_count) }}</h3>
                <p class="mb-0 opacity-90">Fanlar soni</p>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 bg-gradient-warning text-white">
                <i class="fas fa-file-alt fa-3x mb-3 opacity-75"></i>
                <h3 class="mb-0">{{ number_format($documents) }}</h3>
                <p class="mb-0 opacity-90">Yuklangan hujjatlar</p>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 bg-gradient-danger text-white">
                <i class="fas fa-video fa-3x mb-3 opacity-75"></i>
                <h3 class="mb-0">{{ number_format($videos) }}</h3>
                <p class="mb-0 opacity-90">Video darslar</p>
            </div>
        </div>
    </div>

    <!-- 2-qator: Qo‘shimcha ma’lumotlar -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Jami savollar</h5>
                        <h2 class="text-primary mb-0">{{ number_format($quizzes) }}</h2>
                    </div>
                    <i class="fas fa-question-circle fa-3x text-primary opacity-25"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Bugun test yechganlar</h5>
                        <h2 class="text-success mb-0">tez kunda...</h2>
                    </div>
                    <i class="fas fa-chart-line fa-3x text-success opacity-25"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Hujjat yuklab olingan</h5>
                        <h2 class="text-info mb-0">tez kunda...</h2>
                    </div>
                    <i class="fas fa-download fa-3x text-info opacity-25"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- 3-qator: Eng faol fanlar -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-trophy text-warning me-2"></i>
                        Eng ko‘p materialga ega fanlar
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach($top_subjects as $subj)
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3 p-3 border rounded-3 hover-shadow">
                                @if($subj->image)
                                    <img src="{{ asset('storage/' . $subj->image) }}" class="rounded-circle" width="50" height="50">
                                @else
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:50px;height:50px;">
                                        {{ Str::substr($subj->name, 0, 2) }}
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-bold">{{ $subj->name }}</h6>
                                    <small class="text-muted">
                                        {{ $subj->documents_count }} hujjat • {{ $subj->videos_count ?? 0 }} video
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<style>
    .bg-gradient-primary { background: linear-gradient(135deg, #6366f1, #8b5cf6) !important; }
    .bg-gradient-success { background: linear-gradient(135deg, #10b981, #34d399) !important; }
    .bg-gradient-warning { background: linear-gradient(135deg, #f59e0b, #fbbf24) !important; }
    .bg-gradient-danger  { background: linear-gradient(135deg, #ef4444, #f97316) !important; }
    .hover-shadow:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important; transition: all 0.3s; }
</style>
@endsection