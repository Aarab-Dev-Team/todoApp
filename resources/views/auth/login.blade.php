<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In · My Tasks</title>
    <meta name="description" content="Sign in to access your tasks">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sand:    { DEFAULT: '#F0E295', light: '#FBF7D9', muted: '#E8D87A', dark: '#C8BB52', soft: '#F9F5E6' },
                        burg:    { DEFAULT: '#5C0D13', light: '#8B1A22', muted: '#3E090D', surface: '#F9F0F1', glow: '#5C0D131A' },
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body:    ['"DM Sans"', 'sans-serif'],
                    },
                    boxShadow: {
                        'md3':     '0 1px 3px rgba(92,13,19,.12), 0 4px 12px rgba(92,13,19,.08)',
                        'md3-lg':  '0 2px 8px rgba(92,13,19,.14), 0 8px 24px rgba(92,13,19,.10)',
                        'md3-xl':  '0 4px 16px rgba(92,13,19,.16), 0 12px 32px rgba(92,13,19,.12)',
                        'glow':    '0 0 0 4px rgba(240,226,149,.3)',
                        'input':   '0 0 0 3px rgba(240,226,149,.4)',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'shake': 'shake 0.5s cubic-bezier(.36,.07,.19,.97) both',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-6px)' },
                        },
                        shake: {
                            '10%, 90%': { transform: 'translateX(-1px)' },
                            '20%, 80%': { transform: 'translateX(2px)' },
                            '30%, 50%, 70%': { transform: 'translateX(-4px)' },
                            '40%, 60%': { transform: 'translateX(4px)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #F9F0F1;
            min-height: 100vh;
            color: #5C0D13;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        /* ── Animated background ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 10% 20%, #F0E29550 0%, transparent 65%),
                radial-gradient(ellipse 50% 60% at 85% 80%, #5C0D1320 0%, transparent 65%),
                radial-gradient(ellipse 40% 40% at 50% 50%, #F0E29530 0%, transparent 75%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── MD3 State Layer ── */
        .state-layer {
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }
        .state-layer::after {
            content: '';
            position: absolute;
            inset: 0;
            background: currentColor;
            opacity: 0;
            transition: opacity 150ms ease;
            pointer-events: none;
            z-index: 1;
        }
        .state-layer:hover::after  { opacity: 0.06; }
        .state-layer:active::after { opacity: 0.12; }
        .state-layer:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #F0E295, 0 0 0 6px rgba(92,13,19,.15);
        }

        /* ── Input Styles ── */
        .md3-input {
            transition: all 200ms cubic-bezier(.4,0,.2,1);
            background: #fff;
        }
        .md3-input:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(240,226,149,.5);
            border-color: #5C0D13;
            background: #fff;
        }
        .md3-input::placeholder {
            color: #5C0D1340;
            transition: color 200ms;
        }
        .md3-input:focus::placeholder {
            color: #5C0D1320;
        }
        .md3-input.error {
            border-color: #DC2626;
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        /* ── Checkbox Custom Style ── */
        .md3-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #5C0D1340;
            border-radius: 6px;
            background: #fff;
            cursor: pointer;
            position: relative;
            transition: all 150ms ease;
            flex-shrink: 0;
        }
        .md3-checkbox:hover {
            border-color: #5C0D13;
            background: #F9F0F1;
        }
        .md3-checkbox:checked {
            background: #5C0D13;
            border-color: #5C0D13;
        }
        .md3-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 1px;
            width: 5px;
            height: 9px;
            border: solid #F0E295;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .md3-checkbox:focus-visible {
            box-shadow: 0 0 0 3px #F0E295;
        }

        /* ── Animations ── */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(32px) scale(.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .animate-card { animation: slideUp 0.5s cubic-bezier(.16,1,.3,1) both; }
        .animate-fade { animation: fadeIn 0.4s ease-out both; }

        /* ── Password Toggle ── */
        .password-toggle {
            transition: color 150ms ease;
        }
        .password-toggle:hover {
            color: #5C0D13;
        }

        /* ── Error Message ── */
        .error-message {
            color: #DC2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .error-message::before {
            content: '⚠';
            font-size: 0.75rem;
        }

        /* ── Session Status Alert ── */
        .status-alert {
            background: #D1FAE5;
            color: #065F46;
            border-left: 4px solid #10B981;
            padding: 0.75rem 1rem;
            border-radius: 0 12px 12px 0;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: slideUp 0.3s ease-out;
        }
        .status-alert::before {
            content: '✓';
            font-weight: bold;
        }

        /* ── Reduced Motion ── */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>

    {{-- ══════════════════════════════════════════
         LOGIN CARD
    ══════════════════════════════════════════ --}}
    <div class="w-full max-w-md animate-card">
        
        {{-- Brand Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-burg shadow-md3-lg mb-4 float">
                <span class="material-symbols-rounded text-sand text-3xl">lock</span>
            </div>
            <h1 class="font-display text-3xl text-burg font-bold tracking-tight">Welcome Back</h1>
            <p class="text-burg/60 text-sm mt-1">Sign in to continue to My Tasks</p>
        </div>

        {{-- Session Status (Laravel) --}}
        @if(session('status'))
            <div class="status-alert" role="status">
                {{ session('status') }}
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}" class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-md3-lg border border-sand/40 p-6 sm:p-8 space-y-6">
            @csrf

            {{-- Email Field --}}
            <div class="space-y-2">
                <label for="email" class="text-xs font-semibold text-burg/70 uppercase tracking-wider flex items-center gap-2">
                    <span class="material-symbols-rounded text-base text-burg/40">mail</span>
                    Email Address
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="you@example.com"
                    class="md3-input w-full border border-burg/15 rounded-2xl px-4 py-3.5
                           text-burg placeholder-burg/30 text-sm font-medium
                           hover:border-burg/30 focus:bg-white
                           {{ $errors->has('email') ? 'error' : '' }}"
                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                    @if($errors->has('email')) aria-describedby="email-error" @endif
                >
                @error('email')
                    <p id="email-error" class="error-message" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Field --}}
            <div class="space-y-2">
                <label for="password" class="text-xs font-semibold text-burg/70 uppercase tracking-wider flex items-center gap-2">
                    <span class="material-symbols-rounded text-base text-burg/40">lock</span>
                    Password
                </label>
                <div class="relative">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="md3-input w-full border border-burg/15 rounded-2xl px-4 py-3.5 pr-12
                               text-burg placeholder-burg/30 text-sm font-medium
                               hover:border-burg/30 focus:bg-white
                               {{ $errors->has('password') ? 'error' : '' }}"
                        aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                        @if($errors->has('password')) aria-describedby="password-error" @endif
                    >
                    <button
                        type="button"
                        class="password-toggle absolute right-3 top-1/2 -translate-y-1/2 p-1 text-burg/40"
                        onclick="togglePassword('password', this)"
                        aria-label="Toggle password visibility"
                    >
                        <span class="material-symbols-rounded text-lg show-icon">visibility</span>
                        <span class="material-symbols-rounded text-lg hide-icon hidden">visibility_off</span>
                    </button>
                </div>
                @error('password')
                    <p id="password-error" class="error-message" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me + Forgot Password --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-1">
                <label class="inline-flex items-center gap-2.5 cursor-pointer group">
                    <input
                        id="remember_me"
                        name="remember"
                        type="checkbox"
                        class="md3-checkbox"
                    >
                    <span class="text-sm text-burg/70 group-hover:text-burg transition-colors">Remember me</span>
                </label>

                @if(Route::has('password.request'))
                    <a 
                        href="{{ route('password.request') }}"
                        class="text-sm font-medium text-burg/60 hover:text-burg transition-colors state-layer rounded-lg px-2 py-1"
                    >
                        Forgot password?
                    </a>
                @endif
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                class="state-layer w-full bg-burg hover:bg-burg-light text-sand font-semibold text-sm
                       rounded-2xl py-4 px-6 flex items-center justify-center gap-2.5
                       shadow-md3 transition-all duration-200 hover:shadow-md3-lg active:scale-[.99]
                       focus-visible:shadow-glow mt-2"
            >
                <span class="material-symbols-rounded text-xl">login</span>
                Sign In
            </button>
        </form>

        {{-- Register Link --}}
        <div class="text-center mt-6 animate-fade" style="animation-delay: .1s">
            <p class="text-sm text-burg/50">
                Don't have an account? 
                <a 
                    href="{{ route('register') }}"
                    class="font-semibold text-burg hover:text-burg-light transition-colors state-layer rounded-lg px-2 py-1"
                >
                    Create one
                </a>
            </p>
        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-burg/30 mt-8 animate-fade" style="animation-delay: .2s">
            Secure sign-in · <time datetime="{{ date('Y') }}">{{ date('Y') }}</time>
        </p>

    </div>

    {{-- Password Toggle Script --}}
    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const showIcon = btn.querySelector('.show-icon');
            const hideIcon = btn.querySelector('.hide-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                showIcon.classList.add('hidden');
                hideIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                showIcon.classList.remove('hidden');
                hideIcon.classList.add('hidden');
            }
        }

        // Auto-focus email on load
        document.addEventListener('DOMContentLoaded', () => {
            const emailInput = document.getElementById('email');
            if (emailInput && !emailInput.value) {
                emailInput.focus();
            }
            
            // Add error styling on load if Laravel returned errors
            @if($errors->any())
                document.querySelectorAll('.md3-input.error').forEach(el => {
                    el.focus();
                });
            @endif
        });
    </script>

</body>
</html>