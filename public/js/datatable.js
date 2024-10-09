const renderActions = (id) => `
    <button class="btn btn-secondary btn-sm btn-edit" data-id="${id}" data-toggle="modal" data-target="#editModal">
        <i class="fas fa-pencil-alt fa-sm"></i> Editar
    </button>
    <button class="btn btn-danger btn-sm btn-delete" data-id="${id}">
        <i class="fas fa-trash-alt"></i> Eliminar
    </button>
`;

const initializeDataTable = () => {
    $('#dt-programacion').DataTable({
        ajax: {
            url: "/programacion-data",
            dataSrc: ""
        },
        columns: [
            { data: "nombre" },
            { data: "tipo" },
            { data: "regla" },
            { data: "cuando" },
            { data: "programacion" },
            { data: "dia",
                render: function (data, type, row) {
                    const dias = {
                        '1': 'Lunes',
                        '2': 'Martes',
                        '3': 'Miércoles',
                        '4': 'Jueves',
                        '5': 'Viernes',
                        '6': 'Sábado',
                        '7': 'Domingo',
                        '*': 'Todos los días'
                    };
                    return dias[data] || data;
                }
            },
            { data: "hora" },
            { data: "sh" },
            { data: "activo", 
                render: function (data, type, row) {
                    return data === 'S' ? 'Sí' : 'No';
                } 
            },
            { data: "id", render: renderActions }
        ],
        responsive: true,
        autoWidth: false,
        dom: 'Bfrtip',
        buttons: [],
        language: {
            paginate: {
                next: '<i class="fas fa-chevron-right"></i>',
                previous: '<i class="fas fa-chevron-left"></i>'
            }
        }
    });
};

export { initializeDataTable };