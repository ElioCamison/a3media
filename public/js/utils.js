export const showAlert = (message, alertClass) => {
    $('#alertMessage').text(message).removeClass('alert-danger alert-success').addClass(alertClass);
    $('#alertContainer').show();
    setTimeout(() => $('#alertContainer').fadeOut(), 3000);
};

export const handleAjaxSuccess = (message) => {
    $('#editModal, #createModal').modal('hide');
    $('#dt-programacion').DataTable().ajax.reload();
    showAlert(message, 'alert-success');
};

export const handleAjaxError = () => {
    showAlert("Ocurrió un error al procesar la solicitud.", 'alert-danger');
};

export const populateEditForm = (data) => {
    $('#editId').val(data.id);
    $('#editNombre').val(data.nombre);
    $('#editTipo').val(data.tipo);
    $('#editRegla').val(data.regla);
    $('#editCuando').val(data.cuando);
    $('#editProgramacion').val(data.programacion);
    $('#editHora').val(data.hora);
    $('#editSh').val(data.sh);
    $('#editActivo').val(data.activo === 'S' ? 'S' : 'N');

    // Marcar los días de la semana
    $('input[name="dia"]').prop('checked', false);
    if (data.dia) {
        $('input[name="dia"]').filter(`[value="${data.dia}"]`).prop('checked', true);
    }
};