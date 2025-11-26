{{-- resources/views/admin/videos/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Video darslar')

@section('content')
<div class="container-fluid py-4">

    <!-- Sarlavha + Qo‘shish tugmasi -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 fw-bold text-dark">
                Video darslar
            </h2>
            <p class="text-muted mb-0">Jami: {{ $videos_count }} ta video</p>
        </div>

        <button type="button"
                class="btn btn-primary btn-lg rounded-pill shadow-sm"
                data-bs-toggle="modal"
                data-bs-target="#addVideoModal">
            Yangi video qo‘shish
        </button>
    </div>

    <!-- Muvaffaqiyat xabari -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Videolar ro‘yxati -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            @if($videos_count > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">№</th>
                                <th>Sarlavha</th>
                                <th>URL</th>
                                <th>Yuklangan</th>
                                <th class="text-end pe-4">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos as $video)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $video->title }}</div>
                                </td>
                                <td>
                                    <small class="text-muted text-break">
                                        {{ Str::limit($video->url, 50) }}
                                    </small>
                                </td>
                                <td>{{ $video->created_at }}</td>
                                <td class="text-end pe-4">
                                    <!-- Ko‘rish -->
                                    <a href="{{ $video->url }}" target="_blank"
                                       class="btn btn-outline-success btn-sm rounded-pill">
                                        YouTube'da ko‘rish
                                    </a>

                                    <!-- O‘chirish -->
                                    <form action="{{  route('admin.videos.delete', $video->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm rounded-pill ms-2"
                                                onclick="return confirm('Bu videoni o‘chirishni xohlaysizmi?')">
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
                    <i class="fab fa-youtube fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Video darslar mavjud emas</h5>
                    <p class="text-muted">Birinchi videoni qo‘shish uchun yuqoridagi tugmani bosing</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal: Yangi video qo‘shish -->
<div class="modal fade" id="addVideoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('video.store', $subject->id) }}" method="POST">
            @csrf
            <div class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger">
                        Yangi video qo‘shish
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body pt-4">

                    <!-- Fan tanlash -->
                    <div class="mb-4">
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                    </div>

                    <!-- Video sarlavhasi -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Video sarlavhasi</label>
                        <input type="text" name="title" class="form-control form-control-lg rounded-3"
                               placeholder="Masalan: Kvadrat tenglamalarni yechish usullari" required>
                    </div>

                    <!-- YouTube URL -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">YouTube video havolasi</label>
                        <input type="url" name="url" class="form-control form-control-lg rounded-3"
                               placeholder="https://www.youtube.com/watch?v=abc123xyz" required>
                        <div class="form-text text-muted mt-2">
                            Faqat to‘liq YouTube havolasini kiriting
                        </div>
                    </div>

                    <!-- Oldindan ko‘rish -->
                    <div class="mt-4">
                        <label class="form-label fw-bold mb-3">Oldindan ko‘rish</label>
                        <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg">
                            <iframe id="previewIframe" src="" allowfullscreen class="border-0"></iframe>
                        </div>
                    </div>

                </div>

                <div class="modal-footer border-0 pt-3">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        Bekor qilish
                    </button>
                    <button type="submit" class="btn btn-danger rounded-pill px-5 shadow-sm">
                        Saqlash
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('input[name="url"]').addEventListener('input', function () {
        let url = this.value.trim();
        let videoId = '';

        if (url.includes('v=')) {
            videoId = url.split('v=')[1]?.split('&')[0];
        } else if (url.includes('youtu.be')) {
            videoId = url.split('youtu.be/')[1]?.split('?')[0];
        }

        const iframe = document.getElementById('previewIframe');
        iframe.src = videoId ? `https://www.youtube.com/embed/${videoId}` : '';
    });
</script>
@endsection