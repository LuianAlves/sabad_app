<div class="dropdown">
    <button class="dropdown-toggle text-dark" type="button" id="dropdown-table"
        data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: none;">
        <small style="font-weight: 500; letter-spacing: 0.25px;">Ações</small>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdown-table" style="font-size: 12px !important;">
        <li>
            <a class="dropdown-item" href="{{route($route.'.show', $id)}}">
                <i class="fa-solid fa-expand text-primary"></i>
                <span class="ms-2">Visualizar registro</span>
            </a>
        </li>
        <li class="my-1">
            <a class="dropdown-item" href="{{route($route.'.edit', $id)}}">
                <i class="fa-solid fa-pen-to-square text-success"></i>
                <span class="ms-2">Editar registro</span>
            </a>
        </li>
        <li>
            <a href="#" class="dropdown-item"></a>
        </li>
        <li>
            <a class="dropdown-item" href="{{route($route.'.destroy', $id)}}">
                <i class="fa-solid fa-trash-can text-danger"></i>
                <span class="ms-2">Excluir registro</span>
            </a>
        </li>
    </ul>
</div>
