@extends('layouts.templates.app-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <x-card-header title="Criar Nova Permissão" count="" action=""></x-card-header>

                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-3">
                            <x-input
                                col="4"
                                set=""
                                type="text"
                                title="Nome da permissão"
                                id="name"
                                name="name"
                                placeholder="Ex.: view entities"
                                require="1"
                            ></x-input>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Salvar Permissão</button>
                        <a href="{{ route('permissions.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
