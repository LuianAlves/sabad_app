@role('user')
@extends('layouts.templates.user-profile-layout') 

@section('content-user-layout')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4" style="height: calc(100vh - 17.5vh) !important;">

                <x-card-header-collaborator title="Novo Ticket" action="Cadastrar"></x-card-header-collaborator>

                <x-form route="store">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="user_id" class="form-control-label">Usuário</label>
                            <select name="user_id" id="user_id" class="form-control" disabled>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == auth()->id() ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Importante: campo hidden para enviar no form -->
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        </div>

                        <div class="col-6">
                            <label for="ticket_category_id" class="form-control-label">Categoria</label>
                            <select name="ticket_category_id" id="ticket_category_id" class="form-control">
                                @foreach ($ticketCategories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <x-input col="6" set="" type="text" title="Titulo" id="title" name="title"
                            value="" placeholder=""></x-input>
                        <x-input col="6" set="" type="text" title="Descrição" id="descreption"
                            name="descreption" value="" placeholder=""></x-input>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
@endrole