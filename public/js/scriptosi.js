$(document).ready(function () {
    'use strict';

    new DataTable('#table-incidencias', {
        autoWidth: true,
        columnDefs: [
            { targets: '_all', width: 'auto' }
        ],
        initComplete: function () {
            let table = this;

            table.api().columns().every(function (index) {
                let column = this;

                if (index < table.api().columns().indexes().length - 1) {
                    let footer = column.footer();

                    if (footer !== null) {
                        let title = footer.textContent;

                        let input = document.createElement('input');
                        input.style.width = '100%';
                        input.placeholder = title;
                        footer.replaceChildren(input);

                        input.addEventListener('keyup', () => {
                            if (column.search() !== input.value) {
                                column.search(input.value).draw();
                            }
                        });
                    }
                }
            });

            table.on('draw.dt', function () {
                let botones = document.getElementsByClassName('btn-ver');

                for (let i = 0; i < botones.length; i++) {
                    botones[i].addEventListener('click', function (e) {
                        $.ajax({
                            type: "GET",
                            url: "http://127.0.0.1:8000/incidenciasosi/show/" + botones[i].getAttribute('data-id'),
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
                }
                // Código para eventos en botones
                let botones_revisar = document.getElementsByClassName('btn-revisar');
                for (let i = 0; i < botones_revisar.length; i++) {
                    botones_revisar[i].addEventListener('click', function (e) {
                        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        $.ajax({
                            type: "POST",
                            url: "http://127.0.0.1:8000/incidenciasosi/revisar/" + botones_revisar[i].getAttribute('data-id'),
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
                }

                let botones_editar = document.getElementsByClassName('btn-editar');
                for (let i = 0; i < botones_editar.length; i++) {
                    botones_editar[i].addEventListener('click', function (e) {
                        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        $.ajax({
                            type: "POST",
                            url: "http://127.0.0.1:8000/incidenciasosi/editar/" + botones_editar[i].getAttribute('data-id'),
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
                }
            });
        }
    });

    let form = document.getElementById('form-import');

    form.addEventListener('submit', function (e) {
        let button_cargar = document.getElementById('cargar');
        let button_cerrar = document.getElementById('cerrar');
        button_cargar.innerHTML = "Cargando...";
        button_cargar.disabled = true;
        button_cerrar.disabled = true;
    })

    let botones = document.getElementsByClassName('btn-ver');

    for (let i = 0; i < botones.length; i++) {
        botones[i].addEventListener('click', function (e) {
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/incidenciasosi/show/" + botones[i].getAttribute('data-id'),
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
    }

    let botones_revisar = document.getElementsByClassName('btn-revisar');
    for (let i = 0; i < botones_revisar.length; i++) {
        botones_revisar[i].addEventListener('click', function (e) {
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/incidenciasosi/revisar/" + botones_revisar[i].getAttribute('data-id'),
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
    }

    let botones_editar = document.getElementsByClassName('btn-editar');
    for (let i = 0; i < botones_editar.length; i++) {
        botones_editar[i].addEventListener('click', function (e) {
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/incidenciasosi/editar/" + botones_editar[i].getAttribute('data-id'),
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
    }
});