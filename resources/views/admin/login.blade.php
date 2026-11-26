@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')

<section class="admin-login-section">

    <div class="admin-login-card">

        {{-- LOGO --}}
        <div class="admin-login-brand">
            <div class="admin-login-logo">E</div>

            <h1>ESSENZA</h1>
            <span>COFFEE</span>
        </div>

        {{-- HEADING --}}
        <div class="admin-login-heading">
            <span class="admin-login-label">ADMINISTRATOR</span>

            <h2>Welcome Back</h2>

            <p>
                Sign in to manage your coffee shop.
            </p>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="admin-login-error">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- LOGIN FORM --}}
        <form action="{{ route('admin.authenticate') }}" method="POST">
            @csrf

            <div class="admin-form-group">
                <label for="email">Email Address</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="admin@essenzacoffee.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="admin-form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button type="submit" class="admin-login-submit">
                Sign In to Dashboard
                <span>→</span>
            </button>

        </form>

        {{-- FOOTER --}}
        <div class="admin-login-footer">
            <a href="{{ route('home') }}">
                ← Back to Essenza Coffee
            </a>
        </div>

        <div class="admin-login-copyright">
            © {{ date('Y') }} Essenza Coffee
        </div>

    </div>

</section>

@endsection

@push('scripts')
<script>
    const passwordInput = document.getElementById('password');

    // Bisa kita tambahkan fitur show/hide password nanti.
</script>
@endpush