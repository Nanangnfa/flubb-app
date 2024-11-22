<h1>Welcome, Pemilik Bisnis!</h1>

<form action="{{ route('business.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>