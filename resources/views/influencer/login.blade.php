<form method="POST" action="{{ route('influencer.login') }}">
    @csrf
    <h2>Login Influencer</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
