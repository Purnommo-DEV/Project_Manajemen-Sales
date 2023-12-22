<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="Assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="Assets/img/favicon.png">
    <title>
        Login Pengguna
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="Assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="Assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="Assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="Assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang</h3>
                                    <p class="mb-0">Silahkan masukkan email dan password anda</p>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('Auth') }}" method="POST" id="formLogin">
                                        @csrf
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email_user"
                                                placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <div class="input-group has-validation">
                                                <input name="password" type="password" id="password_user"
                                                    class="form-control"
                                                    placeholder="Masukkan Password Anda Disini..." />
                                                <span class="input-group-text" style="height: 82%;margin-left: 88%;"
                                                    onclick="password_login_show();">
                                                    <i class="fas fa-eye" id="show_eye"></i>
                                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                </span>
                                                <div class="input-group has-validation">
                                                    <label class="text-danger error-text password_error"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Belum memiliki akun?
                                        <a href="{{ route('Register') }}"
                                            class="text-info text-gradient font-weight-bold">Daftar</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('Assets/img/curved-images/curved6.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="Assets/js/plugins/jquery.min.js"></script>
    <script src="Assets/js/core/popper.min.js"></script>
    <script src="Assets/js/core/bootstrap.min.js"></script>
    <script src="Assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="Assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="Assets/js/plugins/sweetalert.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script>
        function password_login_show() {
            var x = document.getElementById("password_user");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
        $('#formLogin').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 0) {
                        swal({
                            title: "Login gagal !",
                            text: `${data.msg}`,
                            icon: "error",
                            successMode: true
                        });
                    } else if (data.status == 1) {
                        swal({
                                title: "Login berhasil !",
                                text: `${data.msg}`,
                                icon: "success",
                                successMode: true,
                            }),
                            setTimeout(function() {
                                window.location.href = `${data.route}`;
                            }, 1000); // 1 second
                    }
                }
            });
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="Assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
