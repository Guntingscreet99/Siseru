<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('judul')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    @include('bagian.admin.gaya.css')
    @stack('css')

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('bagian.admin.gaya.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            @include('bagian.admin.gaya.navbar')

            <section>
                @yield('isi')
            </section>

            @include('bagian.admin.gaya.footer')
        </div>

        <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeTopBarColor" data-color="dark"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="green"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange"></button>
                            <button type="button" class="changeTopBarColor" data-color="red"></button>
                            <button type="button" class="selected changeTopBarColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="green2"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                            <button type="button" class="changeTopBarColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeSideBarColor" data-color="white"></button>
                            <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="icon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Cek session success
        @if (session('success'))
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // Cek errors
        @if ($errors->any())
            Swal.fire({
                icon: "error",
                title: "Terjadi Kesalahan!",
                html: `
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
                showConfirmButton: true,
                confirmButtonText: "OK"
            });
        @endif
    </script>

    @include('bagian.admin.gaya.js')
    @stack('js')

    @push('css')
        <style>
            .rupaku-add-btn {
                position: relative;
                animation: rupakuPulse 2.8s infinite;
                transition: all 0.35s ease;
            }

            .rupaku-add-btn:hover {
                transform: translateY(-10px) scale(1.05);
                box-shadow: 0 25px 50px rgba(0, 0, 0, .35) !important;
            }

            /* Lingkaran cahaya */
            .rupaku-add-btn::after {
                content: '';
                position: absolute;
                inset: -6px;
                border-radius: inherit;
                border: 2px solid rgba(255, 255, 255, .5);
                opacity: 0;
                animation: ring 2.8s infinite;
            }

            @keyframes rupakuPulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(255, 255, 255, .6);
                }

                70% {
                    box-shadow: 0 0 0 18px rgba(255, 255, 255, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
                }
            }

            @keyframes ring {
                0% {
                    opacity: .8;
                }

                100% {
                    opacity: 0;
                }
            }
        </style>
    @endpush
</body>



</html>
