<div class="form-group clearfix">
    <div class="">
        <input type="checkbox" id="{{$tag}}" name="{{$name}}" value="{{$value}}" {{$attribute}}>
        <label for="{{$tag}}">
        {{$label}}
        </label>
    </div>
</div>

{{-- example
<div class="col-lg-6">
    <x-form.checkbox class="form-control" name="role_id" label="{{ trans('admin.Roles') }}"
    tag="role_id" value="1"
    attribute=""
    />
</div> --}}