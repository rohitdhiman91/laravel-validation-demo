<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($errors->any())
    <ul style="color: red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="/register">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name') }}"><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}"><br><br>

    <label>Age (optional):</label>
    <input type="number" name="age" value="{{ old('age') }}"><br><br>

    <button type="submit">Register</button>
</form>
</body>
</html>
