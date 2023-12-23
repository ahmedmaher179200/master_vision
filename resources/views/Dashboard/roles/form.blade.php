<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
                <x-form.input type="text" class="form-control" attribute="required"
                    name="name" value="{{ isset($data) ? $data->name : old('name') }}"
                    label="{{ trans('admin.Name') }}" />
        </div>

        <div class="col-lg-6">
                <x-form.input type="text" class="form-control" attribute="required"
                    name="description" value="{{ isset($data) ? $data->description : old('description') }}"
                    label="{{ trans('admin.Description') }}"/>
        </div>
    </div>

    <div class="row">
        @foreach (config('global.roles') as $key => $values)
            <div class="col-lg-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{$key}}</h3>
                    </div>
                    
                    <div class="card-body">
                        @foreach ($values as $value)
                            <x-form.checkbox class="form-control" label="{{$value}}" tag="{{$value . '-' . $key}}"
                                value="{{$value . '-' . $key}}"  name="permissions[]"
                                attribute="{{ isset($data) ? $data->hasPermission($value . '-' . $key) ? 'checked' : '' : '' }}"/>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>