 <div class="col-{{ $col }} offset-{{ $set }}">
     <div class="form-group">
         <label class="form-control-label" for="{{ $id }}">{{ $title }}</label>
         <div class="input-group">
             <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $id }}"
                 value="{{ $value }}" placeholder="{{ $placeholder }}" {{ $disabled ? ' disabled' : '' }}>
         </div>
     </div>
 </div>
