<?php
    if(!isset($display))
        $display = "name";

    if(!isset($attribute))
        $attribute = "";
?>

<div class="form-group">
    <label>{{$label}}</label>
    <select {{$attribute}}  {{$attributes->merge(['class' => $class, 'name' => $name, 'id' => $id]) }} style="width: 100%;">
        <option value="" selected @isset($firstDisabled) @if ($firstDisabled == "true") disabled @endif @endisset >{{ trans('admin.Select') }}</option>
                
        @foreach ($collection as $data)
            <option value="{{$data[$index]}}" @if ($data[$index] == $select) selected @endif>{{$data[$display]}}</option>
        @endforeach
    </select>
    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>

{{-- example
<x-form.select class="form-control select2" id="" attribute=""
:collection="$brands" select="{{ isset($data) ? $data->brand_id : old('brand_id') }}" index="id"
name="brand_id" label="{{ trans('admin.brand') }}" /> --}}