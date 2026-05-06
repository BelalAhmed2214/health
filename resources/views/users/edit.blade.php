<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <label for="is_admin">Is Admin:</label>
        <input type="checkbox" id="is_admin" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>