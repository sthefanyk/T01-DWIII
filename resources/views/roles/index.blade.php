<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listagem de Papeis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if(Auth::check())
                    {{-- @can('create', Spatie\Permission\Models\Role::class) --}}
                    <div style="margin-bottom:2%;">
                        <button type="button" class="btn btn-outline-primary">
                            <a href="{{ route('roles.create') }}">Criar Papel</a>
                        </button>
                    </div>
                    {{-- @endcan --}}
                    @endif
                    <!--<ul class="list-group">-->
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Acoes</th>
                                </tr>
                            </thead>

                            <tbody>    
                                @foreach($roles as $role)
                                <tr>
                                <!--<li class="list-group-item d-flex justify-content-between align-items-center">-->
                                    <th scope="row"> {{ $role->id }} </th>
                                    <td> {{ $role->name }} </td>
                                    <td>

                                    <div style="display:flex">    
                                    @auth
                                        <!-- can('delete', $role) -->
                                        {{-- @can('delete', $role) --}}
                                            <div style="margin-right:2%;">
                                                <form method="post" action=" {{ route('roles.destroy', $role) }} "
                                                    onsubmit="return confirm('Tem certeza que deseja REMOVER {{ addslashes($role->titulo) }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        {{-- @endcan --}}
                                        <!--endcan-->
                                        
                                        <!--can('atualizar', $role)-->
                                        {{-- @can('update', $role) --}}
                                            <div style="margin-right:2%;">
                                                <button type="button" class="btn btn-outline-success">
                                                    <a href="{{ route('roles.edit', $role) }}">Editar</a>
                                                </button>
                                            </div>
                                        {{-- @endcan --}}
                                        <!--endcan-->
                                        
                                        <!--can('view', $role)-->
                                        {{-- @can('view', $role) --}}
                                            <div style="margin-right:2%;">
                                                <button type="button" class="btn btn-outline-info">
                                                    <a href="{{ route('roles.show', $role) }}">Permissoes do Papel</a>
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
