@extends('components.layout.layout')

@section('title', 'Code & Lens - Checkout')

@section('content')

<div class="text-text-900">
    <div class="">
        <div class="text-center flex flex-col justify-center items-center">
            <h1 class="font-five text-2xl m-8">Finalizar Inscripción</h1>

            <div class="font-five flex flex-col items-center justify-center">
                <p>{{__('User')}}: {{Auth::user()->name}} {{Auth::user()->lastname}}</p>
                <h2 class="font-bold text-2xl">Curso: {{$course->name}}</h2>
                <h3 class="">{{__('Category')}}: {{$course->category}}</h3>
                <p>Duración: {{$course->duration}}</p>
                <p class="font-bold text-xl">Precio: ${{ number_format($course->price, 2, ',', '.') }}</p>
    
                <img src="{{ asset('storage/courses/'.$course->image) }}" alt="{{$course->name}}" style="max-width: 400px; margin: 20px auto;">

               
                <div id="loading" style="padding: 20px;">
                  <p>Preparando el pago...</p>
                </div>
               
                <div id="walletBrick_container" class="w-[250px]"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("{{ config('services.mercadopago.public_key') }}", {
        locale: 'es-AR'
    });

    const orderData = {
        course_id: {{ $course->id }},
        enroll_day: {{ $selectedDay ?? 'null' }}
    };

    
    fetch('/checkout/process', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || 'Error al crear la preferencia');
            });
        }
        return response.json();
    })
    .then(data => {
        if (!data.success || !data.preference_id) {
            throw new Error('No se recibió el preference_id');
        }

        
        document.getElementById('loading').style.display = 'none';

        
        const bricksBuilder = mp.bricks();
        
        bricksBuilder.create("wallet", "walletBrick_container", {
            initialization: {
                preferenceId: data.preference_id,
            },
            customization: {
                texts: {
                    valueProp: 'smart_option',
                },
            },
        }).then(() => {
            console.log('Wallet Brick renderizado');
        }).catch(error => {
            console.error('Error al renderizar Wallet Brick:', error);
            document.getElementById('walletBrick_container').innerHTML = 
                '<p style="color: red;">Error al cargar el botón de pago. Recarga la página.</p>';
        });
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loading').style.display = 'none';
        document.getElementById('walletBrick_container').innerHTML = 
            '<p style="color: red;">Error: ' + error.message + '</p>';
    });
</script>

@endsection