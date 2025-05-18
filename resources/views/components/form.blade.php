@if ($route == 'store')
    <form method="post" action="{{ route(currentRoute()[0] . '.store') }}">
    @elseif($route == 'update')
        <form method="post" action="{{ route(currentRoute()[0] . '.update', $id) }}">
            @method('PATCH')
@endif
@csrf

<div class="card-header d-flex justify-content-between align-items-center">
    @if ($route == 'store')
        <span class="fw-bold" style="font-size: 12px;">
            <span class="text-muted">Após o cadastro será redirecionado para a tela anterior.</span>
        </span>
    @endif
    <x-card-button button="cadastrar"></x-card-button>
</div>

<div class="card-body">
    {{ $slot }}

</div>


</form>
