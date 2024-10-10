<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="editForm">
                        <div class="row">
                            <!-- Primera Columna -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editNombre">Nombre</label>
                                    <select class="form-control select2" id="editNombre" name="nombre" style="width: 100%;"></select>
                                </div>                                

                                <div class="form-group">
                                    <label for="editProgramacion">Programación</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="editProgramacion" name="programacion">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editCuando">Cuando</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="editCuando" name="cuando">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editRegla">Regla</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-ruler"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="editRegla" name="regla">
                                    </div>
                                </div>
                            </div>

                            <!-- Segunda Columna -->
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="editTipo">Tipo</label>
                                    <select class="form-control select2" id="editTipo" name="tipo" style="width: 100%;"></select>
                                </div>

                                <div class="form-group">
                                    <label for="editDia">Día</label>
                                    <select class="form-control" id="editDia" name="dia[]" multiple>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miércoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sábado</option>
                                    <option value="7">Domingo</option>
                                    <option value="*">Todos los días</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="editHora">Hora</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="time" class="form-control" id="editHora" name="hora">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editSh">SH</label>
                                    <input type="text" class="form-control" id="editSh" name="sh">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Toggle Switch para el Campo Activo -->
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="editActivo" name="activo" checked>
                                <label class="custom-control-label" for="editActivo">Activo</label>
                                </div>
                                <!-- Alerta de Advertencia -->
                                <div id="activoWarning" class="alert alert-warning mt-2" role="alert" style="display: none;">
                                <i class="fas fa-exclamation-triangle"></i> Marcando el botón como inactivo, esta programación <strong>no</strong> tendrá efecto alguno.
                                </div>
                            </div>
                        </div>    

                        <!-- Botón Guardar -->
                        <div class="form-group text-right mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Custom Scripts -->
<script src="/js/form.js"></script>