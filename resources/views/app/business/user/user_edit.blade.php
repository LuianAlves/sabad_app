@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Editar usuário" action="atualizar"></x-card-header>

                <x-form route="update">
                  <div class="row">
                      <x-input col="6" set="" type="text" title="Nome do usuário" id="name" name="name" value="{{$user->name}}" placeholder="John Doe" disabled=""></x-input>
                      <x-input col="6" set="" type="email" title="E-mail" id="email" name="email" value="{{$user->email}}" placeholder="john@email.com" disabled=""></x-input>
                  </div>
                  <div class="row">
                      <x-input col="6" set="" type="password" title="Senha" id="password" name="password" value="{{ \Crypt::decrypt($user->password) }}" placeholder="*******" disabled=""></x-input>
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

{{-- 

No campo da senha a gente precisa descriptografar
ali no componente <x-form> a gente poe a rota: sempre vai ser STORE OU UPDATE
    
sim
Sim já vi isso no curso 

 --}}







