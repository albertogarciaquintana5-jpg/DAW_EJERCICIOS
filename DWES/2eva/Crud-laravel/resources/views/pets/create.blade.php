@extends('layouts.app')

@section('content')
<div class="container py-4">
    <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">
                <i class="bi bi-plus-circle"></i> Registrar Mascota
            </h1>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('pets._form')
                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('pets.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Guardar Mascota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection