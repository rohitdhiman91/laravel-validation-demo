# Laravel Validation Demo

A beginner-friendly Laravel project that demonstrates **form validation** using two approaches:
1. **Controller-based validation** (quick and simple)
2. **Form Request validation** (clean and reusable)

## Features
- User registration form
- Validation rules for name, email, and age
- Error message display in Blade templates

## Installation
1. Clone the repo:
   ```bash
   git clone https://github.com/rohitdhiman91/laravel-validation-demo.git

2. Install dependencies:

   ```bash
   composer install
   ```
3. Configure `.env` for your database.
4. Run migrations:

   ```bash
   php artisan migrate
   ```
5. Start the server:

   ```bash
   php artisan serve
   ```

## Routes

* `GET /register` – Show registration form
* `POST /register` – Process form and validate input

## Example Validation Rules

```php
$request->validate([
    'name'  => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'age'   => 'nullable|integer|min:18'
]);
```

## **📂 Code Files**

**routes/web.php**
```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);
````

**app/Http/Controllers/UserController.php**

```php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    // Show form
    public function create()
    {
        return view('register');
    }

    // Validate & save user
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return redirect('/register')->with('success', 'User registered successfully!');
    }
}
```

**app/Http/Requests/StoreUserRequest.php**

```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'age'   => 'nullable|integer|min:18',
        ];
    }
}
```

**resources/views/register.blade.php**

```blade
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
```