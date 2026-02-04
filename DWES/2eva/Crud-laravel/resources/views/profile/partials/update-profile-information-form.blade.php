<section>
    <header class="mb-3">
        <h3 class="h5">Información del perfil</h3>
        <p class="text-muted mb-0">Actualiza tu nombre y correo electrónico.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="alert alert-warning">
                Tu correo no está verificado.
                <button form="send-verification" class="btn btn-link p-0 align-baseline">Reenviar verificación</button>
            </div>

            @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success">Se ha enviado un nuevo enlace de verificación.</div>
            @endif
        @endif

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">Guardar</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success">Guardado.</span>
            @endif
        </div>
    </form>
</section>
