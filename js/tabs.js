function showTable(tableId) {
    // Ocultar todas las tablas
    document.querySelectorAll('.table-section').forEach(function(section) {
        section.style.display = 'none';
    });

    // Mostrar la tabla seleccionada
    document.getElementById(tableId).style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function() {
    // Mostrar la tabla de clientes por defecto
    showTable('clientes');

    // Añadir eventos de clic a los enlaces de navegación
    document.querySelectorAll('nav a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const tableId = this.getAttribute('data-table');
            showTable(tableId);
        });
    });
});
