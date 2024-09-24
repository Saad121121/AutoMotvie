<x-guest-layout>
    <!-- Session Status -->
    <div class="container mt-5">
        <!-- Session Status -->
        @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <!-- <h1>HELLO DELAER LOGIN</h1> -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}"
                    required autofocus autocomplete="username">
                @if ($errors->has('email'))
                <div class="text-danger mt-2">
                    {{ $errors->first('email') }}
                </div>
                @endif
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" class="form-control" required
                    autocomplete="current-password">
                @if ($errors->has('password'))
                <div class="text-danger mt-2">
                    {{ $errors->first('password') }}
                </div>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                @if (Route::has('password.request'))
                <a class="create-text" style="text-decoration: underline;"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <button type="submit" class="btn btn-primary">
                    {{ __('Log in') }}
                </button>
            </div>

            <!-- <div class="mt-5 text-center">
                @if (Route::has('login'))
                <nav class="d-flex justify-content-center">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="create-text">
                        Dashboard
                    </a>
                    @else
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="create-text">
                        Not Register? Create Your Account
                    </a>
                    @endif
                    @endauth
                </nav>
                @endif
            </div> -->
        
        </form>
    </div>

</x-guest-layout>