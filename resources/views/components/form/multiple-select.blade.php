<?php
    if(!isset($display))
        $display = "name";

    if(!isset($attribute))
        $attribute = "";
?>

<div class="form-group">
    <label>{{$label}}</label>
    <select multiple  {{$attributes->merge(['class' => $class, 'name' => $name, 'id' => $id]) }} style="width: 100%;">
        @foreach ($collection as $data)
            <option value="{{$data[$index]}}" @if (in_array($data[$index], $selectArr)) selected @endif>{{$data[$display]}}</option>
        @endforeach
    </select>
    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>


{{-- example
<x-form.multiple-select class="form-control select2 mainUnitIdDev" id="" attribute="required"
    :collection="$sub_units" :selectArr="$sub_unit_ids" index="id"
    name="sub_unit_ids[]" label="{{ trans('admin.sub units') }}" display="actual_name"/> --}}