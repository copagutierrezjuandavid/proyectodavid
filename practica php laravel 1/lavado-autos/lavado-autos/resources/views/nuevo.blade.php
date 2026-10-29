<div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input
        type="number"
        name="stock"
        id="stock"
        class="form-control @error('stock') is-invalid @enderror"
        value="{{ old('stock', 0) }}"
        min="0"
        step="1"
        required
    >
    @error('stock')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>