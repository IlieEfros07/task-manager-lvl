@extends('layouts.app')

@section('title', 'Detalii Task: ' . $task->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-9">
         <div class="card shadow-lg border-0 rounded-lg">
             <div class="card-header bg-light border-bottom d-flex justify-content-between align-items-center">
                 <h2 class="h4 mb-0 fw-light">
                     <i class="bi bi-card-text me-2"></i> {{ $task->title }}
                 </h2>
                 <div>
                      @if($task->status == 'private')
                         <span class="badge bg-secondary"><i class="bi bi-lock-fill me-1"></i>Privat</span>
                     @else
                         <span class="badge bg-primary"><i class="bi bi-eye-fill me-1"></i>Public</span>
                     @endif
                 </div>
             </div>
             <div class="card-body p-4">
                <p class="card-subtitle mb-3 text-muted small">
                     <i class="bi bi-person-fill me-1"></i> Creat de: <span class="fw-semibold">{{ $task->user->name }}</span>
                     <span class="mx-2">|</span>
                     <i class="bi bi-calendar-plus me-1"></i> {{ $task->created_at->isoFormat('LLLL') }} (acum {{ $task->created_at->diffForHumans() }})
                     @if($task->updated_at != $task->created_at)
                         <br><i class="bi bi-pencil-square me-1"></i> Actualizat acum {{ $task->updated_at->diffForHumans() }}
                     @endif
                 </p>

                @if($task->description)
                    <h5 class="mt-4 mb-2 fw-normal"><i class="bi bi-text-left me-1"></i>Descriere</h5>
                     <div class="p-3 bg-light rounded border" style="white-space: pre-wrap;">
                         {{ $task->description }}
                     </div>
                @else
                     <p class="text-muted fst-italic mt-4">Acest task nu are o descriere.</p>
                @endif

             </div>
             <div class="card-footer bg-light border-top d-flex justify-content-end gap-2 py-3">
                 @can('update', $task)
                     <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-warning">
                         <i class="bi bi-pencil-fill me-1"></i> Editează
                     </a>
                 @endcan
                  @can('delete', $task)
                     <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Ești sigur că vrei să ștergi acest task?');" class="d-inline">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn btn-sm btn-outline-danger">
                             <i class="bi bi-trash-fill me-1"></i> Șterge
                         </button>
                     </form>
                 @endcan
                 <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-secondary">
                     <i class="bi bi-arrow-left me-1"></i> Înapoi la Listă
                 </a>
             </div>
        </div>
    </div>
</div>
@endsection