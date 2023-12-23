<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <x-form.input type="text" class="form-control" attribute="required"
                name="name" value="{{ isset($data) ? $data->name : old('name') }}"
                label="{{ trans('admin.name') }}"/>
        </div>

        <div class="col-lg-6">
            <x-form.select class="form-control select2" id=""
            :collection="$categories" select="{{ isset($data) ? $data->parent_id : old('parent_id') }}" index="id"
            name="parent_id" label="{{ trans('admin.Category') }}"/>
        </div>
    </div>
</div>