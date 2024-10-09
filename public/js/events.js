import { submitForm, deleteRegistro, loadEditForm } from './api.js';

const handleEditClick = (event) => {
    const id = $(event.currentTarget).data('id');
    loadEditForm(id);
    $('#editModalLabel').text('Editar Programación');
    $('#editModal').modal('show');
};

const handleFormSubmit = (event) => {
    event.preventDefault();
    const url = '/programacion/' + $('#editId').val();
    const data = $('#editForm').serialize();
    submitForm(url, 'POST', data, "Registro actualizado con éxito.");
};

const handleCreateSubmit = (event) => {
    event.preventDefault();
    const url = '/programacion';
    const data = $('#newCreateForm').serialize();
    submitForm(url, 'POST', data, "Registro creado con éxito.");
};

const handleDeleteClick = (event) => {
    const id = $(event.currentTarget).data('id');
    deleteRegistro(id);
};

const showCreateModal = () => {
    $('#editModalLabel').text('Agregar Nueva Programación');
    $('#editForm')[0].reset();
    $('#editId').val('');
    $('#editModal').modal('show');
};

const bindEventHandlers = () => {
    $('#dt-programacion').on('click', '.btn-edit', handleEditClick);
    $('#dt-programacion').on('click', '.btn-delete', handleDeleteClick);
    $('#editForm').on('submit', handleFormSubmit);
    $('#newCreateForm').on('submit', handleCreateSubmit);
    $('.btn-success').on('click', showCreateModal);
};

export { bindEventHandlers };
