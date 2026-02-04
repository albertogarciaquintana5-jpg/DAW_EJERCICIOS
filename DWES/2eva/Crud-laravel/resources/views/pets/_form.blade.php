@csrf

<div class="mb-4">
    <label for="nombre" class="form-label fw-bold">
        <i class="bi bi-tag"></i> Nombre <span class="text-danger">*</span>
    </label>
    <input type="text" name="name" id="nombre" class="form-control @error('name') is-invalid @enderror" 
           value="{{ old('name', $pet->name ?? '') }}" placeholder="Ej: Max" required>
    @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>

<div class="mb-4">
    <label for="especie" class="form-label fw-bold">
        <i class="bi bi-paw"></i> Especie <span class="text-danger">*</span>
    </label>
    <input type="text" name="species" id="especie" class="form-control @error('species') is-invalid @enderror" 
           value="{{ old('species', $pet->species ?? '') }}" placeholder="Ej: Perro, Gato, Conejo" required>
    @error('species')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="mb-4 col-md-6">
        <label for="raza" class="form-label fw-bold">
            <i class="bi bi-diagram-3"></i> Raza
        </label>
        <input type="text" name="breed" id="raza" class="form-control @error('breed') is-invalid @enderror" 
               value="{{ old('breed', $pet->breed ?? '') }}" placeholder="Ej: Golden Retriever">
        @error('breed')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>

    <div class="mb-4 col-md-3">
        <label for="edad" class="form-label fw-bold">
            <i class="bi bi-calendar"></i> Edad
        </label>
        <input type="number" name="age" id="edad" class="form-control @error('age') is-invalid @enderror" 
               value="{{ old('age', $pet->age ?? '') }}" placeholder="Ej: 3" min="0">
        @error('age')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>

    <div class="mb-4 col-md-3">
        <label for="sexo" class="form-label fw-bold">
            <i class="bi bi-gender-ambiguous"></i> Sexo
        </label>
        <select name="sex" id="sexo" class="form-select @error('sex') is-invalid @enderror">
            <option value="">-- Selecciona --</option>
            <option value="male" {{ old('sex', $pet->sex ?? '') == 'male' ? 'selected' : '' }}>🐕 Macho</option>
            <option value="female" {{ old('sex', $pet->sex ?? '') == 'female' ? 'selected' : '' }}>🐩 Hembra</option>
        </select>
        @error('sex')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mb-4">
    <label for="descripcion" class="form-label fw-bold">
        <i class="bi bi-chat-left-text"></i> Descripción
    </label>
    <textarea name="description" id="descripcion" rows="3" class="form-control @error('description') is-invalid @enderror" 
              placeholder="Cuéntanos sobre tu mascota...">{{ old('description', $pet->description ?? '') }}</textarea>
    @error('description')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>

<div class="mb-4">
    <label for="imagen" class="form-label fw-bold">
        <i class="bi bi-image"></i> Imagen (opcional)
    </label>
    <input type="file" name="image" id="imagen" class="form-control @error('image') is-invalid @enderror" 
           accept="image/jpeg,image/png,image/webp">
    <small class="text-muted d-block mt-2">Formatos permitidos: JPG, PNG, WEBP (máximo 2MB)</small>
    
    @if(!empty($pet->image ?? null))
        <div class="mt-3">
            <div class="fw-bold mb-2">Imagen actual:</div>
            <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="img-thumbnail" style="max-width:200px">
        </div>
    @endif
    
    @error('image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>