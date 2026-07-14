@extends('components.layout.layout')

@section('title', 'Residencia Carlota - Restablecer Contraseña')

@section('content')
<div class="flex flex-col items-center justify-center py-16 px-4">

   
    <div class="flex flex-col items-center mb-8">
        <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center shadow-lg mb-4">
            <img src="/images/LogoCarlota.png" alt="Residencia Carlota"
                 class="w-12 h-12 object-contain"
                 onerror="this.style.display='none'">
        </div>
        <h1 class="font-two text-2xl font-bold text-text-900">Residencia Carlota</h1>
        <p class="font-one text-xs tracking-widest uppercase text-text-700 mt-1">Restablecer contraseña</p>
    </div>

  
    <div class="w-full max-w-md bg-background-500 rounded-2xl shadow-xl p-8">

        
        <div id="success-msg" class="hidden flex flex-col items-center text-center py-4">
            <i class="fa-solid fa-circle-check text-4xl text-green-500 mb-4"></i>
            <p class="font-two text-lg text-text-900 font-semibold">¡Contraseña actualizada!</p>
            <p class="font-one text-sm text-text-700 mt-2">Ya podés iniciar sesión en la app con tu nueva contraseña.</p>
        </div>

        
        <div id="error-msg" class="hidden bg-red-500 bg-opacity-20 border border-red-500 rounded-lg p-3 mb-4">
            <p id="error-text" class="font-one text-sm text-red-400 text-center"></p>
        </div>

        
        <form id="reset-form">
            <input type="hidden" id="token" value="{{ $token }}">
            <input type="hidden" id="email" value="{{ request('email') }}">

            <div class="mb-5">
                <label for="email-display" class="font-one text-sm text-text-700 block mb-1">
                    Correo electrónico
                </label>
                <input type="email"
                       id="email-display"
                       value="{{ request('email') }}"
                       readonly
                       class="w-full p-3 rounded-lg bg-background-300 text-text-900 border border-background-100 opacity-70 cursor-not-allowed font-one text-sm">
            </div>

            <div class="mb-5">
                <label for="password" class="font-one text-sm text-text-700 block mb-1">
                    Nueva contraseña <span class="text-red-400">*</span>
                </label>
                <input type="password"
                       id="password"
                       placeholder="Mínimo 6 caracteres"
                       required
                       class="w-full p-3 rounded-lg bg-background-300 text-text-900 border border-background-100 focus:outline-none focus:border-variant-100 font-one text-sm transition-colors">
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="font-one text-sm text-text-700 block mb-1">
                    Confirmar contraseña <span class="text-red-400">*</span>
                </label>
                <input type="password"
                       id="password_confirmation"
                       placeholder="Repetí la contraseña"
                       required
                       class="w-full p-3 rounded-lg bg-background-300 text-text-900 border border-background-100 focus:outline-none focus:border-variant-100 font-one text-sm transition-colors">
            </div>

            <button type="submit"
                    id="submit-btn"
                    class="w-full bg-accent2-300 hover:bg-accent2-500 text-text-900 font-bold font-one text-sm py-3 rounded-xl transition-colors duration-300">
                Restablecer contraseña
            </button>
        </form>
    </div>

    <p class="font-one text-xs text-text-700 mt-6">
        ¿Problemas? Contactá al administrador del sistema.
    </p>
</div>

<script>
document.getElementById('reset-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const token    = document.getElementById('token').value;
    const email    = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirm  = document.getElementById('password_confirmation').value;
    const btn      = document.getElementById('submit-btn');
    const errorDiv = document.getElementById('error-msg');
    const errorTxt = document.getElementById('error-text');
    const successDiv = document.getElementById('success-msg');
    const form     = document.getElementById('reset-form');

    
    if (password.length < 6) {
        showError('La contraseña debe tener al menos 6 caracteres.');
        return;
    }
    if (password !== confirm) {
        showError('Las contraseñas no coinciden.');
        return;
    }

    
    btn.disabled = true;
    btn.textContent = 'Procesando...';
    errorDiv.classList.add('hidden');

    try {
        const response = await fetch('https://claudioparedes.site/geriatrico/api/reset-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                token,
                email,
                password,
                password_confirmation: confirm,
            }),
        });

        const data = await response.json();

        if (response.ok) {
            
            form.classList.add('hidden');
            successDiv.classList.remove('hidden');
        } else {
            const msg = data.error || data.message || 'El token es inválido o expiró. Solicitá un nuevo link.';
            showError(msg);
            btn.disabled = false;
            btn.textContent = 'Restablecer contraseña';
        }
    } catch (err) {
        showError('Error de conexión. Verificá tu internet e intentá de nuevo.');
        btn.disabled = false;
        btn.textContent = 'Restablecer contraseña';
    }

    function showError(msg) {
        errorTxt.textContent = msg;
        errorDiv.classList.remove('hidden');
    }
});
</script>
@endsection
