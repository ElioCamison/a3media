
function populateNames() {
    const element = document.getElementById('editNombre');
    const choices = new Choices(element, {
        placeholderValue: 'Seleccione un nombre',
        searchEnabled: true,
        noResultsText: 'No se encontraron resultados',
        itemSelectText: 'Seleccionar',
        removeItemButton: true
    });

    fetch('/api/select-names')
        .then(response => response.json())
        .then(data => {
            choices.setChoices(data.options, 'nombre', 'nombre', true);
        })
        .catch(error => console.error('Error fetching names:', error));
}

function populateTypes() {
    const element = document.getElementById('editTipo');
    const choices = new Choices(element, {
        placeholderValue: 'Seleccione un tipo',
        searchEnabled: true,
        noResultsText: 'No se encontraron resultados',
        itemSelectText: 'Seleccionar',
        removeItemButton: true
    });

    fetch('/api/select-types')
        .then(response => response.json())
        .then(data => {
            const options = data.options.map(option => ({
                value: option.tipo,
                label: option.tipo
            }));

            choices.setChoices(options, 'value', 'label', true);
        })
        .catch(error => console.error('Error fetching types:', error));
}


document.addEventListener('DOMContentLoaded', function() {
    populateNames();
    populateTypes();

    const diaElement = document.getElementById('editDia');
    const choices = new Choices(diaElement, {
      removeItemButton: true,
      placeholderValue: 'Seleccione los días',
      noResultsText: 'No se encontraron resultados',
      itemSelectText: 'Presione para seleccionar',
    });

    const activoToggle = document.getElementById('editActivo');
    const activoWarning = document.getElementById('activoWarning');

    activoToggle.addEventListener('change', function() {
        activoWarning.style.display = activoToggle.checked ? 'none' : 'block';
    });
      
    
});
