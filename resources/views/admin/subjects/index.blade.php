@extends('layouts.admin')

@section('content')
    
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Fanlar</h2>
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">Fan qo`shish</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fan Nomi</th>
                    <th scope="col" class="text-end"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subjects ?? [] as $subject)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $subject->name }}</td>
                        <td class="text-end">
                            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-outline-secondary">Tahrirlash</a>

                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ $subject->name }} ni o`chirishni xoxlaysizmi?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">O`chirish</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Fanlar mavjud emas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($subjects) && method_exists($subjects, 'links'))
        <div class="d-flex justify-content-center mt-3">
            {{ $subjects->links() }}
        </div>
    @endif
</div>

@endsection
