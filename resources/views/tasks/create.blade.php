@extends('layouts.app')

@section('title', 'Creează Task Nou')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
         <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="fw-light my-2">Creează un Task Nou</h3>
            </div>
             <div class="card-body p-4">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titlu <span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" required placeholder="Titlul taskului">
                         @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                         <label for="description" class="form-label">Descriere</label>
                         <textarea id="description" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   rows="4" placeholder="Detalii despre task...">{{ old('description') }}</textarea>
                         @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                         <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="public" {{ old('status', 'public') == 'public' ? 'selected' : '' }}>Public (vizibil pentru toți)</option>
                            <option value="private" {{ old('status') == 'private' ? 'selected' : '' }}>Privat (vizibil doar pentru tine)</option>
                        </select>
                         @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                         <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Anulează</a>
                         <button type="submit" class="btn btn-primary">Salvează Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection