@extends('layouts.admin')



@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Savollar</h1>
        <a href="{{ route('quizzes.create', ['subject' => $id]) }}" class="btn btn-primary">Savol Yaratish</a>
    </div>   





    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif


    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Savol</th>
                    <th>Variant 1</th>
                    <th>Variant 2</th>
                    <th>Variant 3</th>
                    <th>Variant 4</th>
                    <th>To`g`ri Javob</th>
                    <th class="text-end"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($quizzes as $quiz)
                    <tr>
                        <td>{{ $loop->iteration + ( ($quizzes->currentPage()-1) * $quizzes->perPage() ) }}</td>
                        <td>{{ $quiz->quiz }}</td>
                        <td>{{ $quiz->option1 ?? '-' }}</td>
                        <td>{{ $quiz->option2 ?? '-' }}</td>
                        <td>{{ $quiz->option3 ?? '-' }}</td>
                        <td>{{ $quiz->option4 ?? '-' }}</td>
                        <td>{{ $quiz->answer ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.quizzes.edit', ['quiz'=>  $quiz->id, 'subject'=> $id]) }}" class="btn btn-sm btn-outline-secondary">Tahrirlash</a>

                            <form action="" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">O`chirish</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Savollar mavjud emas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- pagination (if $quizzes is a LengthAwarePaginator) --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            @if(method_exists($quizzes, 'total'))
                <small>Showing {{ $quizzes->firstItem() ?? 0 }} - {{ $quizzes->lastItem() ?? 0 }} of {{ $quizzes->total() }} quizzes</small>
            @endif
        </div>
        <div>
            {{ $quizzes->links('pagination::bootstrap-5') ?? '' }}
        </div>
    </div>
</div>
@endsection