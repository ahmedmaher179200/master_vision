<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <x-form.input type="text" class="form-control" attribute="required"
                name="name" value="{{ isset($data) ? $data->name : old('name') }}"
                label="{{ trans('admin.name') }}"/>
        </div>

        <div class="col-lg-6">
            <div class="">
                @php
                    $product_ids = [];
                    if(isset($data)){
                        $product_ids = $data->Products()->pluck('product_id')->toArray();
                    }
                @endphp
                <x-form.multiple-select class="form-control select2" id="" display="name"  attribute="required"
                    :collection="$products" :selectArr="$product_ids" index="id"
                    name="product_ids[]" label="{{ trans('admin.products') }}"/>
            </div>
        </div>
    </div>
</div>