<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pb-5">
                <div class="text-center mb-4">
                    <h1 class="role-title">Rol Nuevo</h1>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row" action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <input type="hidden"id="rolId" name="id"/>
                    <div class="col-12">
                        <label class="form-label" for="modalRoleName">Nombre del Rol</label>
                        <input
                            type="text"
                            id="modalRoleName"
                            name="name"
                            class="form-control"
                            placeholder="Nombre del rol"
                            tabindex="-1"
                            data-msg="Please enter role name"
                            required
                        />
                    </div>
                    <div class="col-12" id="permisos">
                        <h4 class="mt-2 pt-50">Roles y Permisos</h4>
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">
                                            Secciones
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                                <i data-feather="info"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="S" value="S"/>
                                                <label class="form-check-label" for="selectAll"> Seleccionar todas </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @for ($i = 1; $i <= $max; $i++)
                                    <tr>
                                        <td class="text-nowrap fw-bolder">{{ __('roles.rol.' . $i) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="{{ "rol_".$i."A" }}" name="perms[]" value="{{ $i."A" }}"/>
                                                    <label class="form-check-label" for="{{ "rol_".$i."A" }}"> Agregar </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="{{ "rol_".$i."B" }}" name="perms[]" value="{{ $i."B" }}"/>
                                                    <label class="form-check-label" for="{{ "rol_".$i."B" }}"> Editar </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="{{ "rol_".$i."C" }}" name="perms[]" value="{{ $i."C" }}"/>
                                                    <label class="form-check-label" for="{{ "rol_".$i."C" }}"> Listar </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="{{ "rol_".$i."D" }}" name="perms[]" value="{{ $i."D" }}"/>
                                                    <label class="form-check-label" for="{{ "rol_".$i."D" }}"> Eliminar </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-primary me-1" id="guardarRol">Enviar</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                            Cancelar
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
    <!--/ Add Role Modal -->
