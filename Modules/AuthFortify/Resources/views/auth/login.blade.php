<form method="POST" action="{{ route('login') }}">
    @csrf
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <button> Enviar</button>
</form>
