@extends('layouts.admin')


@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Subject: {{ $subject->name ?? '—' }}</h1>
        <div>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-sm">Back to list</a>
            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary btn-sm">Edit</a>

            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this subject?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <th scope="row" style="width: 200px;">ID</th>
                        <td>{{ $subject->id ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Name</th>
                        <td>{{ $subject->name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Code</th>
                        <td>{{ $subject->code ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td>{!! nl2br(e($subject->description ?? '—')) !!}</td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td>{{ isset($subject->is_active) ? ($subject->is_active ? 'Active' : 'Inactive') : ($subject->status ?? '—') }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Created At</th>
                        <td>{{ optional($subject->created_at)->format('Y-m-d H:i') ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Updated At</th>
                        <td>{{ optional($subject->updated_at)->format('Y-m-d H:i') ?? '—' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection