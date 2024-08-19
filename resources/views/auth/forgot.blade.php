<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{ asset('img/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Icewall admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Icewall Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>E-Bike Polinema</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <!-- END: CSS Assets-->

</head>
<!-- END: Head -->

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Icewall Tailwind HTML Admin Template" class="w-6" src="{{ asset('img/logo.svg') }}">
                    <span class="text-white text-lg ml-3"> E-Bike Polinema </span>
                </a>
                <div class="my-auto">
                    <img alt="Icewall Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                        src="{{ asset('img/bike.png') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        Berkendara tanpa polusi
                        <br>
                        dengan E-Bike
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Silahkan login
                        menggunakan akun Anda</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->

            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h1 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Peminjaman E-Bike</h1>
                    <br>
                    <h4 class="intro-x text-xl xl:text-2xl text-center xl:text-left">
                        Lupa Password
                    </h4></br>
                    <form action="{{ route('forgot') }}" class="mt-4" method="POST">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="intro-x mt-2">

                            <input type="email"
                                class="intro-x login__input form-control py-3 px-4 block @error('email')
                            is-invalid
                        @enderror"
                                placeholder="example@company.com" name="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                          
                        </div>
                      
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" name="submit"
                                class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Reset</button>
                    </form>
                    <a href="{{ route('login') }}"
                        class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Masuk</a>
                </div>
                {{-- <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left"> Dengan bergabung Anda setuju dengan <a class="text-primary dark:text-slate-200" href="kk.php">Kebijakan dan Ketentuan</a></div> --}}
            </div>
        </div>
        <!-- END: Login Form -->
    </div>
    </div>
    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <!-- END: JS Assets-->
</body>

</html>
