@extends('layouts.admin')

@section('title', trans('admin.products'))


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.products') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.products') }}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
              <a href="{{route('dashboard.products.create')}}" type="button" class="btn btn-info">{{ trans('admin.Add') }}</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('admin.Name') }}</th>
                <th>{{ trans('admin.price') }}</th>
                <th>{{ trans('admin.description') }}</th>
                <th>{{ trans('admin.category') }}</th>
                <th>{{ trans('admin.Created at') }}</th>
                <th>{{ trans('admin.Actions') }}</th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($products as $product)
                      <tr>
                          <td>{{$product->id}}</td>
                          <td>{{$product->name}}</td>
                          <td>{{$product->price}}</td>
                          <td>{{$product->description}}</td>
                          <td>
                            @if ($product->Category)
                                {{$product->Category->name}}
                            @endif
                          </td>
                          <td>{{$product->created_at}}</td>
                          <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-success">{{ trans('admin.Actions') }}</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="{{route('dashboard.products.edit',$product->id)}}">{{ trans('admin.Edit') }}</a>

                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default-{{$product->id}}">{{ trans('admin.Delete') }}</a>
                                </div>
                              </div>

                              @include('partials.delete_confirmation', [
                                'url' => route('dashboard.products.destroy',$product->id),
                                'modal_id'  => 'modal-default-' . $product->id,
                              ])
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('script')
<script>
  $.fn.dataTable.ext.search.push(
      function( settings, data, dataIndex ) {
        //role filter
        var role = $('#role').val();
        if(data[3] === role || role == ''){ var role_status = true } else { var role_status = false};

        if(role_status)
          return true;

        return false;
      }
  );

  $(document).ready(function () {
      // filter
      $('#role').on('change', function () {
        table1.draw().buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });
  });
</script>
@endsection
