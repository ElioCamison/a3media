$(document).ready(function() {
    $('#dt-programacion').DataTable({
        "ajax": {
            "url": "/programacion-data",
            "dataSrc": ""
        },
        "columns": [
            { "data": "nombre" },
            { "data": "tipo" },
            { "data": "regla" },
            { "data": "cuando" },
            { "data": "programacion" },
            { "data": "dia" },
            { "data": "hora" },
            { "data": "sh" },
            { "data": "activo" },
            {
                "data": "id",
                "render": function(data) {
                    return  `
                        <button class="btn btn-primary btn-edit" data-id="${data}" data-toggle="modal" data-target="#editModal">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteRegistro(${data})">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </button>
                    `;
                }
            }
        ],
        "responsive": true,
        "autoWidth": false,
        "dom": 'Bfrtip',
        "buttons": [],
        "language": {
            "paginate": {
                "next": '<i class="fas fa-chevron-right"></i>',
                "previous": '<i class="fas fa-chevron-left"></i>'
            }
        }
    });

    $('#dt-programacion').on('click', '.btn-edit', function() {
        const id = $(this).data('id');
        loadEditForm(id);
    });

    $('#editForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: `/programacion/${$('#editId').val()}`,
            method: 'POST',
            data: formData,
            success: function() {
                $('#editModal').modal('hide');
                $('#dt-programacion').DataTable().ajax.reload();

                $('#alertMessage').text("Registro actualizado con éxito.").removeClass('alert-danger').addClass('alert-success');
                $('#alertContainer').show();
                setTimeout(function() {
                    $('#alertContainer').fadeOut();
                }, 3000);
            },
            error: function() {
                $('#alertMessage').text("Error al guardar los cambios.").removeClass('alert-success').addClass('alert-danger');
                $('#alertContainer').show();
                setTimeout(function() {
                    $('#alertContainer').fadeOut();
                }, 3000);
            }
        });
    });

    $('#newCreateForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        debugger

        $.ajax({
            url: '/programacion',
            method: 'POST',
            data: formData,
            success: function() {
                $('#createModal').modal('hide');
                $('#dt-programacion').DataTable().ajax.reload(); // Recarga la tabla
                
                $('#alertMessage').text("Registro creado con éxito.")
                                  .removeClass('alert-danger')
                                  .addClass('alert-success');
                $('#alertContainer').show();
                
                setTimeout(function() {
                    $('#alertContainer').fadeOut();
                }, 3000);
            },
            error: function() {
                $('#alertMessage').text("Error al crear el registro.")
                                  .removeClass('alert-success')
                                  .addClass('alert-danger');
                $('#alertContainer').show();
                
                setTimeout(function() {
                    $('#alertContainer').fadeOut();
                }, 3000);
            }
        });
    });

    // Evento para mostrar el modal de agregar nueva programación
    $('.btn-success').on('click', function() {
        $('#editModalLabel').text('Agregar Nueva Programación'); // Cambia el título del modal
        $('#editForm')[0].reset(); // Limpia el formulario
        $('#editId').val(''); // Asegúrate de que el ID esté vacío
        $('#editModal').modal('show'); // Muestra el modal
    });

    // Evento para editar un registro
    $('#dt-programacion').on('click', '.btn-edit', function() {
        const id = $(this).data('id');
        loadEditForm(id); // Carga los datos del registro
        $('#editModalLabel').text('Editar Programación'); // Cambia el título del modal a editar
        $('#editModal').modal('show'); // Muestra el modal
    });
});

function deleteRegistro(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
        // Lógica para eliminar el registro
        $.ajax({
            url: `/delete/${id}`,
            method: 'DELETE',
            success: function(response) {
                // Recarga el DataTable para reflejar los cambios
                $('#dt-programacion').DataTable().ajax.reload();

                $('#alertMessage').text("Registro eliminado con éxito.")
                                  .removeClass('alert-danger')
                                  .addClass('alert-success');
                $('#alertContainer').show();
                
                setTimeout(function() {
                    $('#alertContainer').fadeOut();
                }, 3000);
            },
            error: function(error) {
                $('#alertMessage').text("Ocurrió un error al eliminar el registro.")
                                  .removeClass('alert-success')
                                  .addClass('alert-danger');
                $('#alertContainer').show();
                
                setTimeout(function() {
                    $('#alertContainer').fadeOut();
                }, 3000);
            }
        });
    }
}

function loadEditForm(id) {
    $.ajax({
        url: `/programacion/${id}`,
        method: 'GET',
        success: function(data) {
            $('#editId').val(data.id);
            $('#editNombre').val(data.nombre);
            $('#editTipo').val(data.tipo);
            $('#editRegla').val(data.regla);
            $('#editCuando').val(data.cuando);
            $('#editProgramacion').val(data.programacion);
            $('#editHora').val(data.hora);
            $('#editSh').val(data.sh);
            $('#editActivo').val(data.activo === 'S' ? 'S' : 'N');

            $('input[name="dia"]').each(function() {
                $(this).prop('checked', false);
                if ($(this).val() === data.dia) {
                    $(this).prop('checked', true);
                }
            });
        },
        error: function() {
            alert('Error al cargar los datos del registro.');
        }
    });
}

