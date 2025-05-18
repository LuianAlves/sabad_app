

@if($button == 'novo')
<a href="{{route(currentRoute()[0].'.create')}}" type="button" class="btn btn-sm btn-warning btn-icon d-flex align-items-center mb-0">
  <span class="btn-inner--icon">
    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="d-block me-2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
    </svg>
  </span>
  <span class="btn-inner--text">Novo</span>
</a>
@endif

@if($button == 'cadastrar')
<button type="submit" class="btn btn-sm btn-warning btn-icon d-flex align-items-center mb-0">
  <span class="btn-inner--icon">
    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="d-block me-2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
    </svg>
  </span>
  <span class="btn-inner--text">Cadastrar</span>
</button>
@endif

@if($button == 'atualizar')
<button type="submit" class="btn btn-sm btn-warning btn-icon d-flex align-items-center mb-0">
  <span class="btn-inner--icon">
    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="d-block me-2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.25 2.094A7.5 7.5 0 016.582 9H4m0 0L9 4m11 16v-5h-.582m-15.25-2.094A7.5 7.5 0 0017.418 15H20m0 0l-5 5" />
    </svg>
  </span>
  <span class="btn-inner--text">Atualizar</span>
</button>
@endif





