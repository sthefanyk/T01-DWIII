<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if(Auth::check())
                    @can('create', App\Models\User::class)
                    <div style="margin-bottom:2%;">
                        <button type="button" class="btn btn-outline-primary">
                            <a href="{{ route('users.create') }}">Criar Usuário</a>
                        </button>
                    </div>
                    @endcan
                    @endif
                    <!--<ul class="list-group">-->
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Usuário</th>
                                <th scope="col">Acoes</th>
                                </tr>
                            </thead>

                            <tbody>    
                                @foreach($users as $user)
                                <tr>
                                <!--<li class="list-group-item d-flex justify-content-between align-items-center">-->
                                    <th scope="row"> {{ $user->id }} </th>
                                    <td> {{ $user->name }} </td>
                                    <td>

                                    <div style="display:flex">    
                                    @auth
                                        <!-- can('delete', $user) -->
                                        @can('delete', $user)
                                            <div style="margin-right:2%;">
                                                <form method="post" action=" {{ route('users.destroy', $user) }} "
                                                    onsubmit="return confirm('Tem certeza que deseja REMOVER {{ addslashes($user->titulo) }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan
                                        <!--endcan-->
                                        
                                        <!--can('atualizar', $user)-->
                                        @can('update', $user)
                                            <div style="margin-right:2%;">
                                                <button type="button" class="btn btn-outline-success">
                                                    <a href="{{ route('users.edit', $user) }}">Editar</a>
                                                </button>
                                            </div>
                                        @endcan
                                        <!--endcan-->
                                        
                                        <!--can('view', $user)-->
                                        {{-- @can('view', $user) --}}
                                            <div style="margin-right:2%;">
                                                <button type="button" class="btn btn-outline-info">
                                                    <a href="{{ route('users.show', $user) }}">Papeis do Usuario</a>
                                                </button>
                                            </div>
                                        {{-- @endcan --}}
                                        <!--endcan-->
                                    @endauth
                                    </div>
                                    </td>
                                <!--</li>-->

                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>

        </div>            
    </div>
</x-app-layout>
