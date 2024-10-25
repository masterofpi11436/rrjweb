    <h2>Reset Password</h2>
    <form action="{{ route('login.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>

        <label for="password">New Password</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <button type="submit">Reset Password</button>
    </form>

    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    @error('email')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    @error('password')
        <p style="color: red;">{{ $message }}</p>
    @enderror
