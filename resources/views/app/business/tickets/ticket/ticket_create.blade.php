@extends('layouts.templates.app-layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header title="Novo Ticket" action="Cadastrar"></x-card-header>

                <x-form route="store">
                  <div class="row">
                      <div class="col-6">
                            <label for="user_id" class="form-control-label">Usuário</label>
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ ($user_id ?? old('user_id')) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="ticketcategory_id" class="form-control-label">Categoria</label>
                            <select name="ticketcategory_id" id="ticketcategory_id" class="form-control">
                                @foreach ($ticketcategories as $ticketcategory)
                                    <option value="{{ $ticketcategory->id }}" {{ ($ticketcategory_id ?? old('user_id')) == $ticketcategory->id ? 'selected' : '' }}>
                                        {{ $ticketcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                      <x-input col="6" set="" type="text" title="Titulo" id="title" name="title" value="" placeholder="" disabled=""></x-input>
                      <x-input col="6" set="" type="text" title="Descrição" id="descreption" name="descreption" value="" placeholder="" disabled=""></x-input>
                      
                      {{-- FALTA O INPUT DOS DOCUMENTOS --}}
                </x-form>
            </div>
        </div>
    </div>
@endsection
