<h1>Welcome, Influencer!</h1>

<form action="{{ route('influencer.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>