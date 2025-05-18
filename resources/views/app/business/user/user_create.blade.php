@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                {{-- 
                
                Esse componente aqui é o cabeçalho da página: <x-card-header></x-card-header>

                o "action" aceita os valores: 'cadastrar' e 'atualizar'
                
                Como essa view é a de create (usamos a rota de store) a gente usa o cadastrar.

                na view de edit a gente colocaria action="atualizar"

                OK

                vou fazer a view de user_edit agora
                Quer ver?

                sim sim vamos lá
                
                --}}
                <x-card-header title="Novo usuário" action="cadastrar"></x-card-header>

                <x-form route="store">
                  <div class="row">
                      <x-input col="6" set="" type="text" title="Nome do usuário" id="name" name="name" value="" placeholder="John Doe" disabled=""></x-input>
                      <x-input col="6" set="" type="email" title="E-mail" id="email" name="email" value="" placeholder="john@email.com" disabled=""></x-input>
                  </div>
                  <div class="row">
                      <x-input col="6" set="" type="password" title="Senha" id="password" name="password" value="" placeholder="*******" disabled=""></x-input>
                      <x-input col="6" set="" type="password" title="Confirmar senha" id="password" name="password" value="" placeholder="*******" disabled=""></x-input>
                  </div>
                  <div class="row">
                      <x-input-check col="6" set="" title="Usuário é administrador?" id="is_admin" name="is_admin" checked="" disabled=""></x-input>
                      <x-input-check col="6" set="" title="Iniciar ativo?" id="is_active" name="is_active" checked="" disabled=""></x-input>
                  </div>
                </x-form>

            </div>
        </div>
    </div>
@endsection

