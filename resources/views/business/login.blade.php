<form method="POST" action="{{ route('business.login') }}">
    @csrf
    <h2>Login Pemilik Bisnis</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
