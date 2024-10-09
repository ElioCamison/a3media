const renderActions = (id) => `
    <button class="btn btn-primary btn-edit" data-id="${id}" data-toggle="modal" data-target="#editModal">Editar</button>
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
            { data: "dia" },
            { data: "hora" },
            { data: "sh" },
            { data: "activo" },
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