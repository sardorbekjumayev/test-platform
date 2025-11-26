{{-- resources/views/admin/subjects/documents/index.blade.php --}}
@extends('layouts.admin')

@section('title', $subject->name . ' - Hujjatlar')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 fw-bold text-dark">
                {{ $subject->name }} — Hujjatlar
            </h2>
            <p class="text-muted mb-0">Jami: {{ $documents->count() }} ta hujjat</p>
        </div>

        <!-- MUHIM: data-bs-toggle va data-bs-target qo‘shildi -->
        <button type="button" 
                class="btn btn-primary btn-lg rounded-pill shadow-sm" 
                data-bs-toggle="modal" 
                data-bs-target="#addDocumentModal">
            <i class="fas fa-plus me-2"></i>Yangi hujjat qo‘shish
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            @if($documents->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">№</th>
                                <th>Fayl nomi</th>
                                <th>Turi</th>
                                <th>Hajmi</th>
                                <th>Yuklangan</th>
                                <th class="text-end pe-4">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $doc)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @php
                                            $ext = pathinfo($doc->file_path, PATHINFO_EXTENSION);
                                            $icon = match(strtolower($ext)) {
                                                'pdf' => 'fa-file-pdf text-danger',
                                                'doc','docx' => 'fa-file-word text-primary',
                                                'ppt','pptx' => 'fa-file-powerpoint text-warning',
                                                'xls','xlsx' => 'fa-file-excel text-success',
                                                default => 'fa-file text-secondary'
                                            };
                                        @endphp
                                        <i class="fas {{ $icon }} fa-2x"></i>
                                        <div>
                                            <div class="fw-semibold">{{ $doc->title }}</div>
                                            <small class="text-muted">{{ $doc->fileName }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark">{{ strtoupper($ext) }}</span></td>
                                <td>{{ $doc->fileSize }}</td>
                                <td>{{ $doc->created_at->format('d.m.Y H:i') }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ Storage::url($doc->file_path) }}" target="_blank" 
                                       class="btn btn-outline-success btn-sm rounded-pill">
                                        Ko‘rish
                                    </a>
                                    <form action="{{ route('admin.documents.delete', $doc->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill ms-2"
                                                onclick="return confirm('O‘chirishni tasdiqlang')">
                                            O‘chirish
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Hujjatlar mavjud emas</h5>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal — TO‘G‘RI YOZILGAN -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('document.store', $subject->id) }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content rounded-4 shadow-lg">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Yangi hujjat qo‘shish — {{ $subject->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Hujjat nomi</label>
                        <input type="text" name="title" class="form-control form-control-lg" 
                               placeholder="Masalan: Algebra 11-sinf testlar" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Fayl tanlash</label>
                        <input type="file" name="document" class="form-control form-control-lg" 
                               accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" required>
                        <div class="form-text">PDF, Word, Excel, PowerPoint. Maks: 20MB</div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                        Bekor qilish
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-5">
                        Saqlash
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection