<div class="mb-4">
    <label for="captcha" class="form-label">Captcha</label>
    <input id="captcha"
           type="number"
           name="captcha"
           class="form-control @error('captcha') is-invalid @enderror"
           value="{{ old('captcha') }}"
           required
           autocomplete="off"
           placeholder="{{ $num1 }} + {{ $num2 }} = ?">
    @error('captcha')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
