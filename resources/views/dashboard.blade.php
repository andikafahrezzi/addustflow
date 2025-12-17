<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>

<p>Login sebagai: {{ auth()->user()->name }}</p>
<p>Role: {{ auth()->user()->role->name }}</p>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>

</body>
</html>
