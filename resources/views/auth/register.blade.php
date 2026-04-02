<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account · My Tasks</title>
    <meta name="description" content="Join My Tasks to organize your day">

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
                        'pulse-soft': 'pulse-soft 3s ease-in-out infinite',
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
                        },
                        'pulse-soft': {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '.85' },
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
            animation: pulse-soft 8s ease-in-out infinite;
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
        .md3-input::placeholder { color: #5C0D1340; transition: color 200ms; }
        .md3-input:focus::placeholder { color: #5C0D1320; }
        .md3-input.error {
            border-color: #DC2626;
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }
        .md3-input.success {
            border-color: #10B981;
            background: #ECFDF5;
        }

        /* ── Password Strength Meter ── */
        .strength-meter {
            height: 4px;
            border-radius: 2px;
            background: #5C0D1310;
            overflow: hidden;
            margin-top: 8px;
            transition: all 200ms ease;
        }
        .strength-meter::after {
            content: '';
            display: block;
            height: 100%;
            width: 0%;
            transition: width 300ms ease, background-color 300ms ease;
            border-radius: 2px;
        }
        .strength-weak::after   { width: 33%; background: #DC2626; }
        .strength-medium::after { width: 66%; background: #F59E0B; }
        .strength-strong::after { width: 100%; background: #10B981; }
        
        .strength-label {
            font-size: 11px;
            font-weight: 600;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .strength-weak-text   { color: #DC2626; }
        .strength-medium-text { color: #F59E0B; }
        .strength-strong-text { color: #10B981; }

        /* ── Password Toggle ── */
        .password-toggle {
            transition: color 150ms ease;
        }
        .password-toggle:hover { color: #5C0D13; }

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

        /* ── Success/Match Indicator ── */
        .match-indicator {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            color: #10B981;
            opacity: 0;
            transform: translateY(-4px);
            transition: all 200ms ease;
        }
        .match-indicator.show {
            opacity: 1;
            transform: translateY(0);
        }
        .match-indicator::before {
            content: '✓';
            font-weight: bold;
            font-size: 0.75rem;
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
        .md3-checkbox:hover { border-color: #5C0D13; background: #F9F0F1; }
        .md3-checkbox:checked { background: #5C0D13; border-color: #5C0D13; }
        .md3-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 5px; top: 1px;
            width: 5px; height: 9px;
            border: solid #F0E295;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .md3-checkbox:focus-visible { box-shadow: 0 0 0 3px #F0E295; }
        .md3-checkbox:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
        .animate-stagger-1 { animation-delay: .05s; }
        .animate-stagger-2 { animation-delay: .1s; }
        .animate-stagger-3 { animation-delay: .15s; }
        .animate-stagger-4 { animation-delay: .2s; }

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
         REGISTRATION CARD
    ══════════════════════════════════════════ --}}
    <div class="w-full max-w-md animate-card">
        
        {{-- Brand Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-burg shadow-md3-lg mb-4 float">
                <span class="material-symbols-rounded text-sand text-3xl">person_add</span>
            </div>
            <h1 class="font-display text-3xl text-burg font-bold tracking-tight">Create Account</h1>
            <p class="text-burg/60 text-sm mt-1">Join My Tasks and start organizing today</p>
        </div>

        {{-- Registration Form --}}
        <form method="POST" action="{{ route('register') }}" class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-md3-lg border border-sand/40 p-6 sm:p-8 space-y-5" id="register-form">
            @csrf

            {{-- Name Field --}}
            <div class="space-y-2 animate-fade animate-stagger-1">
                <label for="name" class="text-xs font-semibold text-burg/70 uppercase tracking-wider flex items-center gap-2">
                    <span class="material-symbols-rounded text-base text-burg/40">person</span>
                    Full Name
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Jane Doe"
                    class="md3-input w-full border border-burg/15 rounded-2xl px-4 py-3.5
                           text-burg placeholder-burg/30 text-sm font-medium
                           hover:border-burg/30 focus:bg-white
                           {{ $errors->has('name') ? 'error' : '' }}"
                    aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                    @if($errors->has('name')) aria-describedby="name-error" @endif
                >
                @error('name')
                    <p id="name-error" class="error-message" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Field --}}
            <div class="space-y-2 animate-fade animate-stagger-2">
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
            <div class="space-y-2 animate-fade animate-stagger-3">
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
                        autocomplete="new-password"
                        placeholder="Create a strong password"
                        class="md3-input w-full border border-burg/15 rounded-2xl px-4 py-3.5 pr-12
                               text-burg placeholder-burg/30 text-sm font-medium
                               hover:border-burg/30 focus:bg-white
                               {{ $errors->has('password') ? 'error' : '' }}"
                        aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                        @if($errors->has('password')) aria-describedby="password-error" @endif
                        oninput="checkPasswordStrength(this.value)"
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
                
                {{-- Password Strength Meter --}}
                <div id="strength-container" class="hidden">
                    <div id="strength-meter" class="strength-meter"></div>
                    <p id="strength-label" class="strength-label"></p>
                </div>
                
                @error('password')
                    <p id="password-error" class="error-message" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password Field --}}
            <div class="space-y-2 animate-fade animate-stagger-4">
                <label for="password_confirmation" class="text-xs font-semibold text-burg/70 uppercase tracking-wider flex items-center gap-2">
                    <span class="material-symbols-rounded text-base text-burg/40">lock_clock</span>
                    Confirm Password
                </label>
                <div class="relative">
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm your password"
                        class="md3-input w-full border border-burg/15 rounded-2xl px-4 py-3.5 pr-12
                               text-burg placeholder-burg/30 text-sm font-medium
                               hover:border-burg/30 focus:bg-white
                               {{ $errors->has('password_confirmation') ? 'error' : '' }}"
                        aria-invalid="{{ $errors->has('password_confirmation') ? 'true' : 'false' }}"
                        @if($errors->has('password_confirmation')) aria-describedby="password_confirmation-error" @endif
                        oninput="checkPasswordMatch()"
                    >
                    <button
                        type="button"
                        class="password-toggle absolute right-3 top-1/2 -translate-y-1/2 p-1 text-burg/40"
                        onclick="togglePassword('password_confirmation', this)"
                        aria-label="Toggle password visibility"
                    >
                        <span class="material-symbols-rounded text-lg show-icon">visibility</span>
                        <span class="material-symbols-rounded text-lg hide-icon hidden">visibility_off</span>
                    </button>
                </div>
                
                {{-- Match Indicator --}}
                <p id="match-indicator" class="match-indicator">Passwords match</p>
                
                @error('password_confirmation')
                    <p id="password_confirmation-error" class="error-message" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- Terms & Privacy Checkbox --}}
            <div class="pt-2 animate-fade" style="animation-delay: .25s">
                <label class="flex items-start gap-3 cursor-pointer group">
                    <input
                        id="terms"
                        name="terms"
                        type="checkbox"
                        class="md3-checkbox mt-0.5"
                        required
                    >
                    <span class="text-sm text-burg/70 group-hover:text-burg transition-colors leading-relaxed">
                        I agree to the 
                        <a href="#" class="font-medium text-burg hover:underline">Terms of Service</a> 
                        and 
                        <a href="#" class="font-medium text-burg hover:underline">Privacy Policy</a>
                    </span>
                </label>
                @error('terms')
                    <p class="error-message mt-2" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                id="submit-btn"
                class="state-layer w-full bg-burg/50 text-sand/60 font-semibold text-sm
                       rounded-2xl py-4 px-6 flex items-center justify-center gap-2.5
                       shadow-md3 cursor-not-allowed mt-4 transition-all duration-200
                       data-[ready=true]:bg-burg data-[ready=true]:text-sand data-[ready=true]:shadow-md3-lg data-[ready=true]:hover:shadow-md3-xl data-[ready=true]:active:scale-[.99] data-[ready=true]:cursor-pointer data-[ready=true]:focus-visible:shadow-glow"
                data-ready="false"
            >
                <span class="material-symbols-rounded text-xl">person_add_alt</span>
                Create Account
            </button>
        </form>

        {{-- Login Link --}}
        <div class="text-center mt-6 animate-fade" style="animation-delay: .3s">
            <p class="text-sm text-burg/50">
                Already have an account? 
                <a 
                    href="{{ route('login') }}"
                    class="font-semibold text-burg hover:text-burg-light transition-colors state-layer rounded-lg px-2 py-1"
                >
                    Sign in
                </a>
            </p>
        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-burg/30 mt-8 animate-fade" style="animation-delay: .35s">
            Secure registration · <time datetime="{{ date('Y') }}">{{ date('Y') }}</time>
        </p>

    </div>

    {{-- Interactive Scripts --}}
    <script>
        // Password visibility toggle
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

        // Password strength checker
        function checkPasswordStrength(password) {
            const container = document.getElementById('strength-container');
            const meter = document.getElementById('strength-meter');
            const label = document.getElementById('strength-label');
            
            if (!password) {
                container.classList.add('hidden');
                return;
            }
            
            container.classList.remove('hidden');
            
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            // Reset classes
            meter.className = 'strength-meter';
            label.className = 'strength-label';
            
            if (strength <= 2) {
                meter.classList.add('strength-weak');
                label.classList.add('strength-weak-text');
                label.innerHTML = '<span class="material-symbols-rounded text-xs">warning</span> Weak password';
            } else if (strength <= 4) {
                meter.classList.add('strength-medium');
                label.classList.add('strength-medium-text');
                label.innerHTML = '<span class="material-symbols-rounded text-xs">info</span> Good password';
            } else {
                meter.classList.add('strength-strong');
                label.classList.add('strength-strong-text');
                label.innerHTML = '<span class="material-symbols-rounded text-xs">check_circle</span> Strong password';
            }
            
            checkFormReady();
        }

        // Password match checker
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            const indicator = document.getElementById('match-indicator');
            
            if (confirmation && password === confirmation) {
                indicator.classList.add('show');
                document.getElementById('password_confirmation').classList.add('success');
            } else {
                indicator.classList.remove('show');
                document.getElementById('password_confirmation').classList.remove('success');
            }
            
            checkFormReady();
        }

        // Enable/disable submit button based on form validity
        function checkFormReady() {
            const isReady = /* your logic */;
            const btn = document.getElementById('submit-btn');

            if (isReady) {
                btn.disabled = false; // This is the magic line!
                btn.dataset.ready = "true";
            } else {
                btn.disabled = true;
                btn.dataset.ready = "false";
            }
        }

        // Event listeners for real-time validation
        document.addEventListener('DOMContentLoaded', () => {
            // Auto-focus name field
            const nameInput = document.getElementById('name');
            if (nameInput && !nameInput.value) nameInput.focus();
            
            // Listen for changes to enable submit button
            document.getElementById('password')?.addEventListener('input', checkFormReady);
            document.getElementById('password_confirmation')?.addEventListener('input', checkFormReady);
            document.getElementById('terms')?.addEventListener('change', checkFormReady);
            
            // Focus first error field on load
            @if($errors->any())
                const firstError = document.querySelector('.md3-input.error');
                if (firstError) firstError.focus();
            @endif
        });
    </script>

</body>
</html>