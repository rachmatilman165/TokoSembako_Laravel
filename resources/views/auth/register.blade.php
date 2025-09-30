<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Register - Toko Sembako Damai</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: #007bff;">
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Toko Sembako Damai</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="max-width: 400px; margin: 80px auto; background: white; padding: 30px; border-radius: 8px; text-align: center;">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width: 80px; height: 80px; margin-bottom: 10px;" />
        <h2 style="margin-bottom: 20px; color: #333;">Toko Sembako Damai</h2>
        <h4>Silahkan Registrasi</h4>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required style="margin-bottom: 15px; height: 40px; font-size: 14px; width: 100%; padding: 5px;" value="{{ old('username') }}" />
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="email" name="email" placeholder="E-Mail" required style="margin-bottom: 15px; height: 40px; font-size: 14px; width: 100%; padding: 5px;" value="{{ old('email') }}" />
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="password" name="password" placeholder="Password" required style="margin-bottom: 15px; height: 40px; font-size: 14px; width: 100%; padding: 5px;" />
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required style="margin-bottom: 15px; height: 40px; font-size: 14px; width: 100%; padding: 5px;" />
            <button type="submit" style="background-color: #007bff; border: none; color: white; width: 100%; padding: 10px; font-size: 16px; border-radius: 5px;">Register</button>
        </form>
    </div>
</body>
</html>
