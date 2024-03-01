$(document).ready(function () {
    'use strict';

    let table = $('#table-incidencias').DataTable({
        autoWidth: true,
        columnDefs: [
            { targets: '_all', width: 'auto' }
        ]
    });

    table.columns().every(function () {
        let column = this;

        let footer = column.footer();

        if (footer !== null) {
            let title = footer.textContent;

            let input = document.createElement('input');
            input.style.width = '100%';
            input.placeholder = title;
            input.classList.add('form-control');
            footer.replaceChildren(input);

            input.addEventListener('keyup', () => {
                if (column.search() !== input.value) {
                    column.search(input.value).draw();
                }
            });
        }
    });

    $('#table-incidencias tbody').on('click', '.btn-ver', function () {
        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/incidenciasosi/show/" + id,
            dataType: "json",
            success: function (incidencia) {
                $("#form-verincidencia input[name='id']").val(incidencia.id);
                $("#form-verincidencia input[name='revisado']").val(incidencia.revisado);
                $("#form-verincidencia input[name='ruc']").val(incidencia.ruc);
                $("#form-verincidencia input[name='fecha']").val(incidencia.fecha);
                $("#form-verincidencia input[name='razonsocial']").val(incidencia.razonsocial);
                $("#form-verincidencia input[name='documento']").val(incidencia.documento);
                $("#form-verincidencia input[name='tipo']").val(incidencia.tipodocumento);
                $("#form-verincidencia input[name='serie']").val(incidencia.serie);
                $("#form-verincidencia input[name='correlativo']").val(incidencia.correlativo);
                $("#form-verincidencia input[name='coderror']").val(incidencia.coderror);
                $("#form-verincidencia textarea[name='descripcion']").val(incidencia.descripcion);

                $('#verincidencia').modal('show');
            }
        });
    });

    $('#table-incidencias tbody').on('click', '.btn-revisar', function () {
        let id = $(this).data('id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/incidenciasosi/revisar/" + id,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                if (response == 1) {
                    window.location.reload();
                }
            }
        });
    });

    $('#table-incidencias tbody').on('click', '.btn-editar', function () {
        let id = $(this).data('id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/incidenciasosi/editar/" + id,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                if (response == 1) {
                    window.location.reload();
                }
            }
        });
    });

});

