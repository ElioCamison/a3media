import { handleAjaxSuccess, handleAjaxError, populateEditForm } from './utils.js';

export const submitForm = (url, method, data, successMessage) => {
    $.ajax({
        url,
        method,
        data,
        success: () => handleAjaxSuccess(successMessage),
        error: handleAjaxError
    });
};

export const deleteRegistro = (id) => {
    if (!confirm("¿Estás seguro de que deseas eliminar este registro?")) return;
    $.ajax({
        url: `/delete/${id}`,
        method: 'DELETE',
        success: () => handleAjaxSuccess("Registro eliminado con éxito."),
        error: handleAjaxError
    });
};

export const loadEditForm = (id) => {
    $.ajax({
        url: `/programacion/${id}`,
        method: 'GET',
        success: populateEditForm,
        error: () => alert('Error al cargar los datos del registro.')
    });
};
