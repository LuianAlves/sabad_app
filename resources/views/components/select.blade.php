 <div class="col-{{ $col }} offset-{{ $set }}">
     <div class="form-group">
         <label for="{{ $id }}">{{ $title }}</label>
         <select class="form-control" id="{{ $id }}" name="{{ $name }}" {{ $disabled ? ' disabled' : '' }}>
             {{ $slot }}
         </select>
     </div>
 </div>
