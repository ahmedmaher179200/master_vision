<section class="content">
    <div class="container-fluid">
      <div class="card collapsed-card">
        <div class="card-header">
          <h3 class="card-title">{{ trans('admin.filter') }}</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="col-lg-6">
              <x-form.select class="form-control select2" id="role"
              :collection="$roles" select="" index="name"
              name="role" label="{{ trans('admin.Roles') }}" firstDisabled="false"/>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </section>