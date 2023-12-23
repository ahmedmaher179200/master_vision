<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <x-form.input type="text" class="form-control" attribute="required"
                name="name" value="{{ isset($data) ? $data->name : old('name') }}"
                label="{{ trans('admin.name') }}"/>
        </div>
        <div class="col-lg-6">
            <x-form.input type="number" class="form-control" attribute="required"
                name="price" value="{{ isset($data) ? $data->price : old('price') }}"
                label="{{ trans('admin.price') }}"/>
        </div>

        <div class="col-lg-6">
            <x-form.select class="form-control select2" id="" attribute="required"
            :collection="$categories" select="{{ isset($data) ? $data->category_id : old('category_id') }}" index="id"
            name="category_id" label="{{ trans('admin.category') }}"/>
        </div>

        <div class="col-lg-6">
            <x-form.input type="file" class="form-control" attribute="required"
                name="image" value="{{ isset($data) ? $data->image : old('image') }}"
                label="{{ trans('admin.image') }}"/>
        </div>

        <div class="col-lg-12">
            <x-form.input type="text" class="form-control" attribute="required"
                name="description" value="{{ isset($data) ? $data->description : old('description') }}"
                label="{{ trans('admin.description') }}"/>
        </div>
    </div>
</div>