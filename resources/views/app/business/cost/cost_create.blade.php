@extends('layouts.templates.app-layout')

@section('content')
    <div class="container">
        <h1>Criar Novo Custo</h1>

        <form method="POST" action="{{ route('cost.store') }}">
            @csrf

            <div class="mb-3">
                <label>Serviço</label>
                <select name="service_id" class="form-control">
                    <option value="">-- selecione --</option>
                    @foreach($services as $s)
                        <option value="{{ $s->id }}">{{ $s->name }} - R$ {{ number_format($s->price, 2, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Dispositivo</label>
                <select name="device_control_id" class="form-control">
                    <option value="">-- selecione --</option>
                    @foreach($devices as $d)
                        <option value="{{ $d->id }}">{{ $d->name }} - R$ {{ number_format($d->estimated_price, 2, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Patrimônio</label>
                <select name="heritage_control_id" class="form-control">
                    <option value="">-- selecione --</option>
                    @foreach($heritages as $h)
                        <option value="{{ $h->id }}">{{ $h->name }} - R$ {{ number_format($h->estimated_price, 2, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Faixa Salarial</label>
                <select name="salary_band_id" class="form-control">
                    <option value="">-- selecione --</option>
                    @foreach($salaries as $sb)
                        <option value="{{ $sb->id }}">{{ $sb->name }} - R$ {{ number_format($sb->salary, 2, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection
