window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple,{
            searchable: false,
            paging:false,
            language: {
                "lengthMenu": "Mostrar _MENU_ entradas",
                "zeroRecords": "Nothing found - sorry",
                "info": "Mostrando page _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)"
            },
           });
    }
});
