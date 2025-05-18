@if ($route == 'store')
    <form method="post" action="{{ route(currentRoute()[0] . '.store') }}">
@elseif($route == 'update')
    <form method="post" action="{{ route(currentRoute()[0] . '.update', $id) }}">
    @method('PATCH')
@endif
@csrf

<div class="card-header d-flex justify-content-between align-items-center">
    @if ($route == 'store')
        <blockquote class="blockquote border-warning">
            <p class="text-muted mb-0 ps-2">Após o cadastro será redirecionado para a tela anterior.</p>
        </blockquote>
        <x-card-button button="cadastrar"></x-card-button>
    @else
        <blockquote class="blockquote border-warning">
                <p class="text-muted mb-0 ps-2">Após a atualização será redirecionado para a tela anterior.</p>
            </blockquote>
        <x-card-button button="atualizar"></x-card-button>
    @endif
</div>

<div class="card-body">
    {{ $slot }}
</div>


</form>
