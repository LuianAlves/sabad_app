<div class="card-header border-bottom pb-0">
     <div class="d-sm-flex align-items-center mb-3">
         <div class="d-flex align-items-center">
             @if (currentRoute()[1] != 'index')
                 <a href="{{ route('ticket.collaborator.index') }}"><i class="fa fa-arrow-left"
                         aria-hidden="true"></i></a>
             @endif
             <div class="mx-3">
                 <h6 class="font-weight-semibold text-lg mb-0">{{ $title }}</h6>
                 @if ($action == 'novo')
                     <p class="text-sm mb-sm-0">Atualmente há {{ $count }} {{ strtolower($title) }} no sistema</p>
                 @endif
             </div>
         </div>
         <div class="ms-auto d-flex">
             @if ($action == 'novo')
                 <div class="input-group input-group-sm ms-auto me-2">
                     <span class="input-group-text text-body">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round"
                                 d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                         </svg>
                     </span>
                     <input type="text" class="form-control form-control-sm" id="inputPesquisarTabela"
                         placeholder="Pesquisar ..">
                 </div>
                 <x-card-button-collaborator button="{{ $action }}"></x-card-button-collaborator>
             @else
                 <span class="fw-bold" style="font-size: 12px;">
                     <span class="text-muted">MISB SYSTEM</span>
                 </span>
             @endif
         </div>
     </div>
 </div>
