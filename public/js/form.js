
function populateNames() {
    $('#editNombre').select2({
      ajax: {
        url: '/api/select-names',
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                term: params.term
            };
        },
        processResults: function (data) {
          return {
            results: data.options.map(function(option) {
              return {
                id: option.nombre,
                text: option.nombre
              };
            })
          };
        },
        error: function (xhr, status, error) {
          console.error("Error en la carga ajax:", error);
        }
      },
      width: 'resolve',
      placeholder: 'Seleccione un nombre',
      allowClear: true
    });
}


function populateTypes() {
    fetch('/api/select-types')
        .then(response => response.json())
        .then(data => {
            const editTipo = $('#editTipo');
            editTipo.empty();

            data.options.forEach(option => {
                const newOption = new Option(option.type, option.type, false, false);
                editTipo.append(newOption);
            });

            editTipo.select2();
        })
        .catch(error => console.error('Error fetching types:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    populateNames();
    populateTypes();
});
