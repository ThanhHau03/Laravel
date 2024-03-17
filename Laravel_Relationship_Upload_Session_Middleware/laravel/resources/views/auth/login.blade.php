<form action="{{ route('process_login') }}" method="post">
    @csrf
    Email
    <input type="text" name="email">
    <br>
    Password
    <input type="text" name="password">
    <br>
    <button>
        Login
    </button>
</form>
