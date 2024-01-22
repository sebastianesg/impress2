
<select 
    class="form-control {{ $class }}" 
    name="{{ $name }}" 
    {{ $req ? 'required' : '' }} 
    {{ $disabled ? 'disabled' : '' }} 
    {{ $multiple ? 'multiple' : '' }}
    id="{{ $name }}"
>
    @if ($null)
    <option value="">{{ $null }}</option>
    @endif
    @foreach ($data as $d)
    <option 
        @foreach ($extraData as $k => $v)
        data-{{ $k }}="{{ strpos($v, "get") !== false ? $d->$v() : $d->$v }}"
        @endforeach

        {{ (!$multiple ? ($val == $d->$id) : (in_array($d->$id, $mSel))) ? 'selected' : '' }} 
        value="{{ $d->$id }}">
        {{ $d->$showTxt() }}
    </option>
    @endforeach
</select>