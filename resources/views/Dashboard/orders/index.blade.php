@extends('layouts.admin')

@section('title', trans('admin.orders'))


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.orders') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.orders') }}</li>
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
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>products</th>
                <th>total</th>
                <th>{{ trans('admin.Created at') }}</th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($orders as $order)
                      <tr>
                          <td>{{$order->id}}</td>
                          <td>{!!$order->GetProductsDetails()!!}</td>
                          <td>{{$order->total}}</td>
                          <td>{{$order->created_at}}</td>
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
