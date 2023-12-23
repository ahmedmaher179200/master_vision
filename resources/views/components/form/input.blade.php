<div class="form-group">
    <label for="username">{{$label}}</label>
    <input {{$attributes->merge(['type' => $type, 'value' => $value, 'class' => $class, 'name' => $name]) }} {{$attribute}}>
    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>
{{-- <div class="col-lg-6">
    <x-form.input type="text" class="form-control" attribute="required"
        name="name" value="{{ isset($data) ? $data->name : old('name') }}"
        label="{{ trans('admin.Name') }}" />
</div> --}}