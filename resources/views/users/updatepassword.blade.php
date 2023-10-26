<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alterar Senha') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="post" action="{{ route('update.password') }}">
                @csrf
                @method('PATCH')
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-start mt-4 gap-2">
                    <x-button class="btn btn-primary">Salvar</x-button>
                    <x-button class="btn btn-secondary bg-red-500">
                        <a href="{{route('noticias.index')}}">Cancelar</a>
                    </x-button>
                </div>
            </form>
        </div>            
    </div>
</x-app-layout>
