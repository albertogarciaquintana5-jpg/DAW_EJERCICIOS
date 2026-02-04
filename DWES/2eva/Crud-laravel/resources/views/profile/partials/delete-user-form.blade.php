<section>
    <header class="mb-3">
        <h3 class="h5">Eliminar cuenta</h3>
        <p class="text-muted mb-0">Esta acción es permanente. Introduce tu contraseña para confirmar.</p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('¿Seguro que quieres eliminar tu cuenta? Esta acción es permanente.');">
        @csrf
        @method('delete')

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" name="password" type="password" class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif" placeholder="Contraseña" />
            @if($errors->userDeletion->has('password'))
                <div class="invalid-feedback">{{ $errors->userDeletion->first('password') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-danger">Eliminar cuenta</button>
    </form>
</section>
