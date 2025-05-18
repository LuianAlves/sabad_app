<div class="dropdown">
    <button class="btn btn-sm btn-dark btn-icon m-0 p-2 dropdown-toggle" type="button" id="dropdown-table"
        data-bs-toggle="dropdown" aria-expanded="false">
        Ações
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdown-table">
        <li>
            <a class="dropdown-item" href="{{route($route.'.show', $id)}}">
                <i class="fa-solid fa-expand"></i>
                <span class="ms-2">Visualizar registro</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{route($route.'.edit', $id)}}">
                <i class="fa-solid fa-pen-to-square"></i>
                <span class="ms-2">Editar registro</span>
            </a>
        </li>
        <li>
            <hr>
        </li>
        <li>
            <a class="dropdown-item" href="{{route($route.'.destroy', $id)}}">
                <i class="fa-solid fa-trash-can"></i>
                <span class="ms-2">Excluir registro</span>
            </a>
        </li>
    </ul>
</div>
