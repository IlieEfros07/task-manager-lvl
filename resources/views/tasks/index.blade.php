@extends('layouts.app')

@section('title', 'Lista Taskuri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
     <h1 class="h3 mb-0 text-gray-800">Taskurile Mele și Publice</h1>
     <a href="{{ route('tasks.create') }}" class="btn btn-primary">
         <i class="bi bi-plus-lg me-1"></i> Task Nou
     </a>
</div>


@if($tasks->isEmpty())
    <div class="alert alert-info shadow-sm" role="alert">
       <i class="bi bi-info-circle-fill me-2"></i> Nu există taskuri de afișat. <a href="{{ route('tasks.create') }}" class="alert-link">Creează unul nou!</a>
    </div>
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($tasks as $task)
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">
                        <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none stretched-link">{{ $task->title }}</a>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted small">
                         <i class="bi bi-person-fill me-1"></i> {{ $task->user->name }}
                         <span class="mx-1">|</span>
                         <i class="bi bi-clock me-1"></i> {{ $task->created_at->diffForHumans() }}
                         <span class="ms-2">
                            @if($task->status == 'private')
                                <span class="badge bg-secondary"><i class="bi bi-lock-fill me-1"></i>Privat</span>
                            @else
                                <span class="badge bg-primary"><i class="bi bi-eye-fill me-1"></i>Public</span>
                            @endif
                         </span>
                    </h6>
                    <p class="card-text flex-grow-1">{{ Str::limit($task->description, 100) }}</p>
                    <div class="mt-auto d-flex justify-content-end gap-2">
                        @can('update', $task)
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-warning position-relative" style="z-index: 1;">
                                <i class="bi bi-pencil-fill me-1"></i> Editează
                            </a>
                        @endcan
                         @can('delete', $task)
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Ești sigur că vrei să ștergi acest task?');" class="d-inline position-relative" style="z-index: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash-fill me-1"></i> Șterge
                                </button>
                            </form>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <div class="mt-4 d-flex justify-content-center">
        {{ $tasks->links() }}
    </div>
@endif

@endsection