@extends('components.layout.layout')

@section('title', 'Code & Lens - Restablecer Contraseña')

@section('content')

    <div class="flex flex-col items-center justify-center text-text-900">
        <h2 class="font-two text-xl p-4">{{ __('Restablecer Contraseña') }}</h2>
        <form action="{{ route('password.email') }}" method="POST" id="resetForm">
            @csrf
            <div class="font-one flex flex-col py-4">
                <label for="email">{{ __('Correo Electrónico') }}</label>
                <input type="email" name="email" id="email" class="bg-accent2-300 p-2 rounded-md my-4 w-80" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-accent2-300 p-2 text-text-900 font-bold text-xs rounded-xl">{{ __('Enviar enlace de restablecimiento') }}</button>
        </form>
        
        <script>
        document.getElementById("resetForm").addEventListener("submit", function(event) {
            event.preventDefault(); 
        
            let formData = new FormData(this);
        
            fetch("{{ route('password.email') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "¡Correo enviado!",
                        text: data.message,
                        confirmButtonText: "Aceptar"
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data.message,
                        confirmButtonText: "Intentar de nuevo"
                    });
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error inesperado",
                    text: "Ocurrió un problema. Inténtalo más tarde.",
                    confirmButtonText: "Cerrar"
                });
            });
        });
        </script>
    </div>
@endsection