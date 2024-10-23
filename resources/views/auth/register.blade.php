<!-- Formulario para iniciar sesion-->

@extends('theme.base')



@section('css')

    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div class="centerLogin">
            <div class="cardF py-5 divCenter">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>


            <!-- Birthday -->
            <div>
                <x-label for="birthday" :value="__('Fecha de nacimiento (año-mes-dia)')" /><br>
             

                <x-input id="birthday" class="block mt-1 w-full" type="text" name="birthday" :value="old('birthday')" required autofocus />
            </div>

            <!-- Birthday -->
            <div>
                <x-label for="documento" :value="__('Documento')" />

                <x-input id="documento" class="block mt-1 w-full" type="number" name="documento" :value="old('documento')" required autofocus />
            </div>
            
             <!-- Birthday -->
             <div>
                <x-label for="city" :value="__('Ciudad de residencia')" />

                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Correo electronico')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Ya estás registrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
    @endsection
