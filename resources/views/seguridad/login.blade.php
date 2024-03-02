<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inicio de Sesión | TusComprobantes.PE</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div style="height: 100vh;" class="row justify-content-center align-items-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5 my-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">INICIO DE SESIÓN</h1>
                                    </div>
                                    <div id="responseForm" class="text-center"></div>
                                    <form id="formLogin" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                aria-describedby="emailHelp" name="email"
                                                placeholder="Ingrese su correo" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Ingrese su contraseña" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Recuérdame</label>
                                            </div>
                                        </div>
                                        <button id="btnSubmit" type="submit"
                                            class="btn btn-primary btn-user btn-block">
                                            Ingresar
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-box-arrow-in-right"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let formLogin = $("#formLogin");
            const contentHTML = (background, message) => {
                return `<div class="alert alert-${background}" role="alert">
                            ${message}
                        </div>`;
            }

            formLogin.submit(function(e) {
                e.preventDefault();

                let formData = new FormData(formLogin[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('seguridad.login') }}",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    processData: false, // Agrega esta línea para evitar que jQuery procese los datos automáticamente
                    contentType: false, // Agrega esta línea para evitar que jQuery establezca automáticamente el tipo de contenido
                    success: function(response) {
                        if (response === "success") {
                            $("#responseForm").html(contentHTML('success', 'Bienvenido! Redireccionando...'));
                            $("#btnSubmit").html("Cargando...");
                            window.location = "{{ route('incidencias.list') }}";
                        }

                        if (response === "error") {
                            $("#responseForm").html(contentHTML('danger', 'Credenciales incorrectas'));
                        }
                    }
                });
            })
        })
    </script>
</body>

</html>
