<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="editForm" >
                <input type="hidden" id="editId" name="id">

                <div class="form-group">
                    <label for="editNombre">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editNombre" name="nombre">
                    </div>
                </div>

                <div class="form-group">
                    <label for="editTipo">Tipo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-cog"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editTipo" name="tipo">
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
                    <label for="editProgramacion">Programación</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editProgramacion" name="programacion">
                    </div>
                </div>

                <div class="form-group">
                    <label for="editDia">Día</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="dia1" name="dia" value="1">
                                <label for="dia1" class="custom-control-label">Lunes</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="dia2" name="dia" value="2">
                                <label for="dia2" class="custom-control-label">Martes</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="dia3" name="dia" value="3">
                                <label for="dia3" class="custom-control-label">Miércoles</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="dia4" name="dia" value="4">
                                <label for="dia4" class="custom-control-label">Jueves</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="dia5" name="dia" value="5">
                                <label for="dia5" class="custom-control-label">Viernes</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="dia6" name="dia" value="6">
                                <label for="dia6" class="custom-control-label">Sábado</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="dia7" name="dia" value="7">
                                <label for="dia7" class="custom-control-label">Domingo</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="diaTodos" name="dia" value="*">
                                <label for="diaTodos" class="custom-control-label">Todos los días</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="editHora">Hora</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editHora" name="hora">
                    </div>
                </div>

                <div class="form-group">
                    <label for="editSh">SH</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-terminal"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editSh" name="sh">
                    </div>
                </div>

                <div class="form-group">
                    <label for="editActivo">Activo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                        </div>
                        <select class="form-control" id="editActivo" name="activo">
                            <option value="S">Sí</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </form>

            </div>
        </div>
    </div>
</div>
