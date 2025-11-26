@extends('layouts.admin')
@section('title', 'Test natijalari')

@section('content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-bold text-primary">
        Test natijalari
    </h2>

    <!-- Filter form -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.results.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Tuman/Shahar</label>
                    <select name="district" class="form-select form-select-lg rounded-3">
                        <option value="">Barcha tumanlar</option>
                        @foreach($districts as $district)
                            <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>
                                {{ $district }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Fan</label>
                    <select name="subject" class="form-select form-select-lg rounded-3">
                        <option value="">Barcha fanlar</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ request('subject') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 px-4">
                            <i class="fas fa-filter me-2"></i> Filterlash
                        </button>
                        <a href="{{ route('admin.results.index') }}" class="btn btn-secondary btn-lg rounded-3">
                            Tozalash
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Natijalar jadvali -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-light">
            <h5 class="mb-0 fw-bold">
                Natijalar ({{ $results->total() }} ta)
            </h5>
        </div>
        <div class="card-body p-0">
            @if($results->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Foydalanuvchi</th>
                                <th>Tuman</th>
                                <th>Fan</th>
                                <th>Ball</th>
                                <th>Boshlangan vaqti</th>
                                <th>Tugagan vaqti</th>
                                <th>Holati</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $loop->iteration + ($results->currentPage() - 1) * $results->perPage() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-primary rounded-circle text-white fw-bold d-flex align-items-center justify-content-center"
                                                 style="width:40px;height:40px;">
                                                {{ Str::substr($result->user->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $result->user->name }}</div>
                                                <small class="text-muted">{{ $result->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark fs-6">{{ $result->district }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success fs-6">{{ $result->subject->name }}</span>
                                    </td>
                                    <td>
                                        @if($result->score !== null)
                                            <strong class="text-primary fs-5">{{ $result->score }} ball</strong>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>{{ $result->created_at->format('d.m.Y H:i') }}</td>
                                    <td>
                                        @if($result->expires_at && $result->expires_at < now())
                                            <span class="text-danger">{{ $result->expires_at->format('d.m.Y H:i') }}</span>
                                        @else
                                            {{ $result->expires_at?->format('d.m.Y H:i') ?? '—' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($result->score !== null)
                                            <span class="badge bg-success">Yakunlangan</span>
                                        @elseif($result->expires_at && $result->expires_at < now())
                                            <span class="badge bg-danger">Vaqt tugagan</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Davom etmoqda</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer bg-white border-top-0">
                    {{ $results->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-chart-bar fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Hech qanday natija topilmadi</h5>
                    <p class="text-muted">Filterlarni o‘zgartirib qayta urinib ko‘ring</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection