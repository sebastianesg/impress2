<form action="{{ $action }}" method="POST">
    @csrf

    @isset($method)
        @method($method)
    @endisset

    <div class="mb-3">
        <label for="name" class="form-label">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $combo->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción:</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $combo->description ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('combos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
