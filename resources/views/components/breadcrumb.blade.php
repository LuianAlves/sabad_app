    {{--  

@php
    $routeName = request()->route()->getName(); // Ex: company.create
    [$resource, $action] = explode('.', $routeName);

    $title = __('breadcrumbs.' . $resource); // Ex: Empresas
    $actionTitle = __('breadcrumbs.' . $action); // Ex: Criar
    $singular = __('breadcrumbs.singular.' . $resource); // Ex: empresa

    $final = in_array($action, ['create', 'edit', 'show']) ? "$actionTitle $singular" : $title;
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
            <a class="opacity-5 text-dark" href="{{ route('dashboard.index') }}">{{ __('breadcrumbs.dashboard') }}</a>
        </li>
        <li class="breadcrumb-item text-sm">
            <a class="opacity-5 text-dark" href="{{ route($resource . '.index') }}">{{ $title }}</a>
        </li>
        <!-- <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $final }}</li> -->
    </ol>
    <h6 class="font-weight-bold mb-0">{{ $final }}</h6>
</nav>
--}}