<!DOCTYPE html>
<html>
<head>
    <title>Login - AddustFlow</title>
</head>
<body>

<h2>Login AddustFlow</h2>

@if ($errors->any())
    <p style="color:red">{{ $errors->first() }}</p>
@endif

<form method="POST" action="/login">
    @csrf

    <div>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>

</body>
</html>
