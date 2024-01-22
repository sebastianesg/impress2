@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Roles')

@section('vendor-style')
@endsection
@section('page-style')
@endsection

@section('content')
<h3>Lista de Roles</h3>

<!-- Role cards -->
<div class="row">
    @foreach($roles as $role)
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between">
                <span>Total {{ $role->getNUsers() }} users</span>
            </div>
            <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                <div class="role-heading">
                    <h4 class="fw-bolder">{{ $role->name }}</h4>
                    <p id="id_rol" class="hidden">{{$role->id}}</p>
                    <a id="btnEditRole" data-perms="{{$role->sections}}" data-name="{{$role->name}}" data-id="{{$role->id}}" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#addRoleModal" style="color: #0a6aa1">
                        <small class="fw-bolder">Editar roles</small>
                    </a>
                </div>
                <button
                    data-id="{{$role->id}}"
                    data-href={{ route('roles.destroy', $role->id) }}
                    class="btn btn-icon btn-icon rounded-circle btn-danger deleteComp"
                    data-txt="¿Desea eliminar este rol?">
                    <i data-feather="trash-2"></i>
                </button>
            </div>
            </div>
        </div>
    </div>
    @endforeach
  <div class="col-xl-4 col-lg-6 col-md-6">
    <div class="card">
      <div class="row">
        <div class="col-sm-5">
          <div class="d-flex align-items-end justify-content-center h-100">
            <img
              src="{{asset('images/illustration/faq-illustrations.svg')}}"
              class="img-fluid mt-2"
              alt="Image"
              width="85"
            />
          </div>
        </div>
        <div class="col-sm-7">
          <div class="card-body text-sm-end text-center ps-sm-0">
            <a
              data-bs-target="#addRoleModal"
              data-bs-toggle="modal"
              class="stretched-link text-nowrap add-new-role"
              id = "btnAddRole"
            >
              <span class="btn btn-primary mb-1">Nuevo Rol</span>
            </a>
            <p class="mb-0">Crear un nuevo rol en caso que no exista</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Role cards -->

@include('cms/admin/modal-add-role')
@endsection

@section('vendor-script')
@endsection
@section('page-script')
{{--  <!-- Page js files -->--}}
  <script src="{{ asset(mix('cms/js/scripts/pages/modal-add-role.js')) }}"></script>
@endsection
