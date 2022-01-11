<form method="POST" action="{{ route('register') }}">
    @csrf
    Name: <input type="name" name="name" required>
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    Confirm Password: <input type="password" name="password_confirmation" required>
    <button> Enviar</button>
</form>
