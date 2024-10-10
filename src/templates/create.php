<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Agregar Nueva Programación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newCreateForm">
                    <div class="form-group">
                        <label for="createNombre">Nombre</label>
                        <input type="text" class="form-control" id="createNombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="createTipo">Tipo</label>
                        <input type="text" class="form-control" id="createTipo" name="tipo" required>
                    </div>
                    <div class="form-group">
                        <label for="createRegla">Regla</label>
                        <input type="text" class="form-control" id="createRegla" name="regla" required>
                    </div>
                    <div class="form-group">
                        <label for="createCuando">Cuando</label>
                        <input type="text" class="form-control" id="createCuando" name="cuando" required>
                    </div>
                    <div class="form-group">
                        <label for="createProgramacion">Programación</label>
                        <input type="text" class="form-control" id="createProgramacion" name="programacion" required>
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
                        <label for="createHora">Hora</label>
                        <input type="text" class="form-control" id="createHora" name="hora" required>
                    </div>
                    <div class="form-group">
                        <label for="createSh">SH</label>
                        <input type="text" class="form-control" id="createSh" name="sh" required>
                    </div>
                    <div class="form-group">
                        <label for="createActivo">Activo</label>
                        <select class="form-control" id="createActivo" name="activo">
                            <option value="S">Sí</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
