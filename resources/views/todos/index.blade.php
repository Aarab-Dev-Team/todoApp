<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks · Organized</title>
    <meta name="description" content="Stay organized with your personal task manager">

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
                        'tonal':   '0 0 0 2px #F0E295, 0 4px 12px rgba(92,13,19,.1)',
                        'glow':    '0 0 0 4px rgba(240,226,149,.3)',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-soft': 'pulse-soft 3s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-8px)' },
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
        }

        /* ── Animated mesh background ── */
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

        /* ── Enhanced Input Styles ── */
        .md3-input {
            transition: all 200ms cubic-bezier(.4,0,.2,1);
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

        /* ── Priority Badges ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .02em;
            text-transform: uppercase;
        }
        .badge-low    { background: #D1FAE5; color: #065F46; }
        .badge-medium { background: #FEF3C7; color: #92400E; }
        .badge-high   { background: #FEE2E2; color: #991B1B; }
        .badge::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
            opacity: .7;
        }

        /* ── Smooth Reveal Animations ── */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px) scale(.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .animate-slide-up { animation: slideUp 0.5s cubic-bezier(.16,1,.3,1) both; }
        .animate-fade-in { animation: fadeIn 0.3s ease-out both; }

        .todo-item { 
            animation: slideUp 0.4s cubic-bezier(.16,1,.3,1) both;
            transform-origin: center bottom;
        }
        .todo-item:nth-child(1) { animation-delay: .05s }
        .todo-item:nth-child(2) { animation-delay: .1s }
        .todo-item:nth-child(3) { animation-delay: .15s }
        .todo-item:nth-child(4) { animation-delay: .2s }
        .todo-item:nth-child(5) { animation-delay: .25s }
        .todo-item:nth-child(n+6) { animation-delay: .3s }

        /* ── Checkbox Animation ── */
        .todo-checkbox {
            transition: all 200ms cubic-bezier(.4,0,.2,1);
            cursor: pointer;
        }
        .todo-checkbox:hover {
            transform: scale(1.1);
            border-color: #5C0D13 !important;
        }
        .todo-checkbox.checked {
            background: #5C0D13;
            border-color: #5C0D13;
            animation: checkPop 200ms ease-out;
        }
        @keyframes checkPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        /* ── Delete Button ── */
        .delete-btn { 
            transition: all 150ms ease; 
        }
        .delete-btn:hover { 
            transform: scale(1.1); 
            background: #FEE2E2 !important;
            color: #991B1B !important;
        }
        .delete-btn:active { transform: scale(.95); }

        /* ── Card Hover Lift ── */
        .card-hover {
            transition: transform 200ms ease, box-shadow 200ms ease, border-color 200ms ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(92,13,19,.12);
            border-color: #F0E295 !important;
        }

        /* ── Floating Elements ── */
        .float-slow { animation: float 7s ease-in-out infinite; }
        .float-medium { animation: float 5s ease-in-out infinite; }

        /* ── Custom Scrollbar ── */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { 
            background: #5C0D1320; 
            border-radius: 4px; 
        }
        ::-webkit-scrollbar-thumb:hover { 
            background: #5C0D1340; 
        }

        /* ── Focus Visible for Accessibility ── */
        :focus-visible {
            outline: 3px solid #F0E295;
            outline-offset: 2px;
        }

        /* ── Reduced Motion Preference ── */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body class="relative z-10 py-8 sm:py-12 px-4 sm:px-6">

    {{-- ══════════════════════════════════════════
         PAGE WRAPPER
    ══════════════════════════════════════════ --}}
    <div class="max-w-2xl mx-auto space-y-10">

        {{-- ── HEADER ── --}}
        <header class="animate-slide-up text-center space-y-3">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-3xl bg-burg shadow-md3-lg mb-2 float-slow">
                <span class="material-symbols-rounded text-sand text-4xl">task_alt</span>
            </div>
            <h1 class="font-display text-4xl sm:text-5xl text-burg font-bold tracking-tight">
                My Tasks
            </h1>
            <p class="text-burg/60 text-sm font-medium max-w-xs mx-auto">
                Stay organized. Stay ahead. <br class="sm:hidden">One task at a time.
            </p>
            
            {{-- Progress Stats --}}
            @php 
                $total = isset($all_todos) ? count($all_todos) : 0;
                $completed = isset($all_todos) ? $all_todos->where('status', 'completed')->count() : 0;
                $progress = $total > 0 ? round(($completed / $total) * 100) : 0;
            @endphp
            @if($total > 0)
            <div class="flex items-center justify-center gap-4 pt-2">
                <div class="flex items-center gap-2 text-xs font-medium text-burg/70">
                    <span class="material-symbols-rounded text-sm">check_circle</span>
                    <span>{{ $completed }}/{{ $total }} done</span>
                </div>
                <div class="w-32 h-2 bg-burg/[.08] rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-sand to-sand-dark rounded-full transition-all duration-500"
                         style="width: {{ $progress }}%"></div>
                </div>
            </div>
            @endif
        </header>


        {{-- ══════════════════════════════════════
             ADD/EDIT TODO CARD
        ══════════════════════════════════════ --}}
        <div class="animate-slide-up rounded-3xl overflow-hidden shadow-md3 border border-sand/40 bg-white/80 backdrop-blur-sm"
             style="animation-delay:.1s">

            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-burg to-burg-light px-6 py-4 flex items-center gap-3">
                <span class="material-symbols-rounded text-sand text-xl animate-pulse-soft">
                    {{ $editTodo ? 'edit' : 'add_circle' }}
                </span>
                <h2 class="font-display text-lg text-sand font-semibold tracking-wide">
                    {{ $editTodo ? 'Edit Task' : 'New Task' }}
                </h2>
            </div>

            {{-- Form Body --}}
            <form 
                action="{{ $editTodo ? route('todos.update', $editTodo->id) : route('todos.store') }}" 
                method="POST" 
                class="p-6 space-y-6"
            >
                @csrf
                @if($editTodo) @method('PUT') @endif

                {{-- Title Field --}}
                <div class="space-y-2">
                    <label for="title" class="text-xs font-semibold text-burg/70 uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-rounded text-base text-burg/40">title</span>
                        Task Title
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        placeholder="What needs to be done?"
                        value="{{ old('title', $editTodo->title ?? '') }}"
                        required
                        aria-required="true"
                        class="md3-input w-full bg-burg/[.03] border border-burg/15 rounded-2xl px-4 py-3.5
                               text-burg placeholder-burg/30 text-sm font-medium transition-all
                               hover:border-burg/30 focus:bg-white"
                    >
                </div>

                {{-- Description Field --}}
                <div class="space-y-2">
                    <label for="description" class="text-xs font-semibold text-burg/70 uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-rounded text-base text-burg/40">notes</span>
                        Description
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        placeholder="Add context, links, or notes… (optional)"
                        class="md3-input w-full bg-burg/[.03] border border-burg/15 rounded-2xl px-4 py-3.5
                               text-burg placeholder-burg/30 text-sm font-medium resize-none transition-all
                               hover:border-burg/30 focus:bg-white"
                    >{{ old('description', $editTodo->description ?? '') }}</textarea>
                </div>

                {{-- Priority + Due Date Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Priority --}}
                    <div class="space-y-2">
                        <label for="priority" class="text-xs font-semibold text-burg/70 uppercase tracking-wider flex items-center gap-2">
                            <span class="material-symbols-rounded text-base text-burg/40">flag</span>
                            Priority
                        </label>
                        <div class="relative">
                            <select
                                id="priority"
                                name="priority"
                                class="md3-input w-full bg-burg/[.03] border border-burg/15 rounded-2xl px-4 py-3.5
                                       text-burg text-sm font-medium appearance-none cursor-pointer transition-all
                                       hover:border-burg/30 focus:bg-white pr-10"
                            >
                                <option value="low"  {{ (old('priority', $editTodo->priority ?? '') == 'low') ? 'selected' : '' }}>🟢 Low</option>
                                <option value="medium" {{ (old('priority', $editTodo->priority ?? '') == 'medium') ? 'selected' : '' }}>🟡 Medium</option>
                                <option value="high" {{ (old('priority', $editTodo->priority ?? '') == 'high') ? 'selected' : '' }}>🔴 High</option>
                            </select>
                            <span class="material-symbols-rounded absolute right-3 top-1/2 -translate-y-1/2
                                         text-burg/40 text-lg pointer-events-none">expand_more</span>
                        </div>
                    </div>

                    {{-- Due Date --}}
                    <div class="space-y-2">
                        <label for="due_date" class="text-xs font-semibold text-burg/70 uppercase tracking-wider flex items-center gap-2">
                            <span class="material-symbols-rounded text-base text-burg/40">calendar_today</span>
                            Due Date
                        </label>
                        <input
                            id="due_date"
                            type="date"
                            name="due_date"
                            value="{{ old('due_date', $editTodo->due_date ?? '') }}"
                            class="md3-input w-full bg-burg/[.03] border border-burg/15 rounded-2xl px-4 py-3.5
                                   text-burg text-sm font-medium transition-all hover:border-burg/30 focus:bg-white
                                   [&::-webkit-calendar-picker-indicator]:opacity-60 [&::-webkit-calendar-picker-indicator]:hover:opacity-100"
                        >
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button
                        type="submit"
                        class="state-layer flex-1 bg-burg hover:bg-burg-light text-sand font-semibold text-sm
                               rounded-2xl py-3.5 px-6 flex items-center justify-center gap-2.5
                               shadow-md3 transition-all duration-200 hover:shadow-md3-lg active:scale-[.99]
                               focus-visible:shadow-glow"
                    >
                        <span class="material-symbols-rounded text-xl">{{ $editTodo ? 'save' : 'add_task' }}</span>
                        {{ $editTodo ? 'Save Changes' : 'Add Task' }}
                    </button>
                    
                    @if($editTodo)
                    <a
                        href="{{ route('todos.index') }}"
                        class="state-layer flex-1 bg-white border-2 border-burg/20 text-burg font-semibold text-sm
                               rounded-2xl py-3.5 px-6 flex items-center justify-center gap-2.5
                               shadow-sm transition-all duration-200 hover:bg-burg/[.04] hover:border-burg/40 active:scale-[.99]"
                    >
                        <span class="material-symbols-rounded text-xl">close</span>
                        Cancel
                    </a>
                    @endif
                </div>
            </form>
        </div>


        {{-- ══════════════════════════════════════
             TODO LIST SECTION
        ══════════════════════════════════════ --}}
        <section class="space-y-4" style="animation-delay:.2s">
            {{-- Section Header --}}
            <div class="flex items-center justify-between px-1">
                <h2 class="font-display text-xl text-burg font-semibold flex items-center gap-2">
                    <span class="material-symbols-rounded text-lg text-burg/40">list</span>
                    All Tasks
                </h2>
                <span class="bg-gradient-to-r from-sand to-sand-light text-burg text-xs font-bold rounded-full px-3.5 py-1.5 shadow-sm border border-sand-dark/20">
                    {{ $count ?? 0 }} {{ ($count ?? 0) === 1 ? 'task' : 'tasks' }}
                </span>
            </div>

            {{-- Todo Items --}}
            @forelse ($all_todos ?? [] as $todo)
                <article class="todo-item group bg-white rounded-2xl shadow-md3 border border-sand/40
                            flex items-start gap-4 px-5 py-4 card-hover"
                         role="listitem"
                         aria-label="Task: {{ $todo->title }}">

                    {{-- Toggle Checkbox --}}
                    <form id="toggle-form-{{ $todo->id }}" 
                          action="{{ route('todos.toggle', $todo->id) }}" 
                          method="POST"
                          class="hidden"
                    >
                        @csrf @method('PATCH')
                    </form>

                    <div 
                        onclick="document.getElementById('toggle-form-{{ $todo->id }}').submit()"
                        role="checkbox"
                        aria-checked="{{ $todo->status == 'completed' ? 'true' : 'false' }}"
                        tabindex="0"
                        onkeypress="if(event.key==='Enter'||event.key===' ')document.getElementById('toggle-form-{{ $todo->id }}').submit()"
                        class="todo-checkbox mt-1 shrink-0 w-6 h-6 rounded-full border-2 
                               {{ $todo->status == 'completed' 
                                   ? 'checked bg-burg border-burg' 
                                   : 'border-burg/40 group-hover:border-burg' }}
                               flex items-center justify-center cursor-pointer"
                        aria-label="{{ $todo->status == 'completed' ? 'Mark as incomplete' : 'Mark as complete' }}"
                    >
                        @if($todo->status == 'completed')
                            <span class="material-symbols-rounded text-sand text-sm">check</span>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0 space-y-2">
                        <p class="text-burg font-semibold text-sm leading-snug {{ $todo->status == 'completed' ? 'line-through opacity-60' : '' }}">
                            {{ $todo->title }}
                        </p>

                        {{-- Meta Row --}}
                        <div class="flex flex-wrap items-center gap-2.5 text-xs">
                            @if(!empty($todo->priority))
                                <span class="badge {{ $todo->priority === 'high' ? 'badge-high' : ($todo->priority === 'low' ? 'badge-low' : 'badge-medium') }}">
                                    {{ ucfirst($todo->priority) }}
                                </span>
                            @endif

                            @if(!empty($todo->due_date))
                                @php
                                    $due = \Carbon\Carbon::parse($todo->due_date);
                                    $isOverdue = $due->isPast() && $todo->status != 'completed';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 text-burg/60 {{ $isOverdue ? 'text-red-600 font-medium' : '' }}">
                                    <span class="material-symbols-rounded text-xs {{ $isOverdue ? 'animate-pulse' : '' }}">
                                        {{ $isOverdue ? 'warning' : 'schedule' }}
                                    </span>
                                    {{ $due->format('M j') }}
                                    @if($isOverdue) <span class="text-[10px] font-bold">OVERDUE</span> @endif
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-1 shrink-0">
                        <a 
                            href="{{ route('todos.index', ['edit' => $todo->id]) }}"
                            class="state-layer w-9 h-9 flex items-center justify-center rounded-xl 
                                   bg-burg/[.05] text-burg/50 hover:bg-sand hover:text-burg transition-all"
                            aria-label="Edit task"
                            title="Edit"
                        >
                            <span class="material-symbols-rounded text-lg">edit</span>
                        </a>
                        
                        <form action="{{ route('todos.delete', $todo->id) }}" method="POST" class="shrink-0">
                            @csrf @method('DELETE')
                            <button
                                type="submit"
                                class="delete-btn state-layer w-9 h-9 flex items-center justify-center
                                       rounded-xl bg-burg/[.05] text-burg/40 hover:bg-red-50 hover:text-red-600"
                                aria-label="Delete task"
                                title="Delete"
                                onclick="return confirm('Delete this task? This cannot be undone.')"
                            >
                                <span class="material-symbols-rounded text-lg">delete</span>
                            </button>
                        </form>
                    </div>
                </article>

            @empty
                {{-- Empty State --}}
                <div class="animate-slide-up bg-white/80 backdrop-blur-sm rounded-3xl shadow-md3 border border-sand/40
                            flex flex-col items-center py-14 px-6 gap-4 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-sand/60 to-sand-light flex items-center justify-center float-medium">
                        <span class="material-symbols-rounded text-5xl text-burg/30">inbox</span>
                    </div>
                    <div class="space-y-1">
                        <p class="font-display text-burg/70 text-lg font-medium">All caught up! 🎉</p>
                        <p class="text-xs text-burg/50 max-w-xs">
                            No tasks yet. Add your first task above to start organizing your day.
                        </p>
                    </div>
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-1.5 text-xs text-burg/40">
                            <span class="material-symbols-rounded text-sm">lightbulb</span>
                            Tip: Break big goals into small, actionable tasks
                        </span>
                    </div>
                </div>
            @endforelse
        </section>

        {{-- Footer --}}
        <footer class="text-center text-xs text-burg/30 pb-2 animate-fade-in" style="animation-delay:.4s">
            <p class="flex items-center justify-center gap-1.5">
                Built with <span class="text-red-400 animate-pulse">♥</span> · 
                <span class="hidden sm:inline">Material Design 3 · </span>
                <time datetime="{{ date('Y') }}">{{ date('Y') }}</time>
            </p>
        </footer>

    </div>

    {{-- Optional: Toast Notification Container --}}
    <div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2 pointer-events-none"></div>

    {{-- Optional: Basic JS Enhancements --}}
    <script>
        // Enhanced checkbox keyboard support
        document.querySelectorAll('.todo-checkbox[tabindex="0"]').forEach(el => {
            el.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    el.click();
                }
            });
        });

        // Optional: Add toast notification helper
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-2xl shadow-md3-lg border ${
                type === 'success' ? 'bg-green-50 border-green-200 text-green-800' :
                type === 'error' ? 'bg-red-50 border-red-200 text-red-800' :
                'bg-white border-burg/10 text-burg'
            } animate-slide-up`;
            toast.innerHTML = `
                <span class="material-symbols-rounded text-lg">${
                    type === 'success' ? 'check_circle' : type === 'error' ? 'error' : 'info'
                }</span>
                <span class="text-sm font-medium">${message}</span>
            `;
            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(10px)';
                setTimeout(() => toast.remove(), 200);
            }, 3000);
        }
    </script>
</body>
</html>