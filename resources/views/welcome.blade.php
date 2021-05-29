<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeSmart - E-Learning</title>
    <link rel="shortcut icon" href="{{ asset("img/logo.png") }}">

    {{-- My Css --}}
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">

    {{-- Eksternal Library --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light responsive" data-aos="fade-down">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <div class="row">
                        <div class="col-2">
                            <span id="icon-navbar">
                                <img src="{{ asset('img/logo.png') }}" width="45px" class="mt-2">
                            </span>
                        </div>
                        <div class="col-3 ml-1" id="title">
                            <p class="mb-0 title-web"><span id="title-name" class="font-weight-bold">B</span>e<span id="title-name" class="font-weight-bold">S</span>mart</p>
                            <p class="text-muted mini-title">Learning Management System</p>
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item active">
                            @if (Auth::guard("student")->check() || Auth::guard("teacher")->check() || Auth::guard("admin")->check())
                                @if (Auth::guard('student')->check())
                                    <a href="{{ route("dashboard.siswa") }}" class="nav-link">
                                        {{ Auth::guard("student")->user()->name}}
                                    </a>
                                @elseif(Auth::guard("teacher")->check())
                                    <a href="{{ route("dashboard.guru") }}" class="nav-link">
                                        {{ Auth::guard("teacher")->user()->name }}
                                    </a>
                                @else
                                    <a href="{{ route("admin.dashboard") }}" class="nav-link">
                                        {{ Auth::guard("admin")->user()->name }}
                                    </a>
                                @endif
                            @else
                                <a href="{{ route("login.form") }}" class="btn btn-sm btn-login">Login</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="content">
                <div class="row flex-column-reverse flex-sm-row">
                    <div class="col-sm-6 align-self-center" data-aos="fade-right">
                        <p class="font-weight-bold text-uppercase mb-0" id="sub-title">Membantu mencetak generasi hebat dan terdepan</p>
                        <div id="underline"></div>
                        <h3 id="text-welcome">Sistem pembelajaran online </h3>
                        <p>BeSmart merupakan sebuah aplikasi berbasis web untuk sistem pembelajaran secara online . 
                            Clean UI , kaya akan fitur , dan tentu saja sangat user friendly . Membantu siswa dan guru
                            dalam melaksanakan pembelajaran secara daring selama masa pandemi , agar meskipun di masa pandemi
                            kualitas pendidikan tidak menurun. </p>
                        @if (Auth::guard("student")->check() || Auth::guard("teacher")->check() || Auth::guard("admin")->check())
                            @if (Auth::guard('student')->check())
                                <a href="{{ route("dashboard.siswa") }}" class="btn btn-started">
                                    Get Started
                                </a>
                            @elseif(Auth::guard("teacher")->check())
                                <a href="{{ route("dashboard.guru") }}" class="btn btn-started">
                                    Get Started
                                </a>
                            @else
                                <a href="{{ route("admin.dashboard") }}" class="btn btn-started">
                                    Get Started
                                </a>
                            @endif
                        @else
                            <a href="{{ route("login.form") }}" class="btn btn-started">Get Started</a>
                        @endif
                    </div>
                    <div class="col-sm-6" data-aos="fade-left">
                        <img src="{{ asset("img/3784896.webp") }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </header>

    
    <div class="container">

        <div class="feature">
            <h3><span id="big-title">F</span>eatures</h3>
            <div id="underline"></div>
            <div class="row" data-aos="fade-down">
                <div class="col-sm-4 mt-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h3 class="card-title">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </h3>
                            </div>
                            <h6 class="card-title mb-2  text-center">User Friendly</h6>
                            <p class="card-text text-center">
                                Learning management system BeSmart sangat mudah digunakan baik untuk siswa maupun guru.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h3 class="card-title">
                                    <i class="fa fa-desktop" aria-hidden="true"></i>
                                </h3>
                            </div>
                            <h6 class="card-title mb-2  text-center">Kaya Fitur</h6>
                            <p class="card-text text-center">
                                Fitur di learning management system BeSmart sangat lengkap dan juga mudah digunakan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h3 class="card-title">
                                    <i class="fa fa-grip-vertical" aria-hidden="true"></i>
                                </h3>
                            </div>
                            <h6 class="card-title mb-2  text-center">Clean UI</h6>
                            <p class="card-text text-center">
                                Ui (User Interface) yang dimiliki oleh BeSmart sangat bersih dan menarik untuk dipandang.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" data-aos="fade-up">
                <div class="col-sm-4 mt-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h3 class="card-title">
                                    <i class="fa fa-money-bill" aria-hidden="true"></i>
                                </h3>
                            </div>
                            <h6 class="card-title mb-2  text-center">Gratis</h6>
                            <p class="card-text text-center">
                                Learning management system BeSmart gratis dan tidak dipunggut biaya apapun ,
                                baik untuk pembuatan atau implementasi
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h3 class="card-title">
                                    <i class="fa fa-server" aria-hidden="true"></i>
                                </h3>
                            </div>
                            <h6 class="card-title mb-2  text-center">Server Uptime</h6>
                            <p class="card-text text-center">
                                Server yang digunakan untuk platform BeSmart ini memiliki kualitas terdepan , 
                                sehingga server nya bisa online 24/7
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h3 class="card-title">
                                    <i class="fa fa-wrench" aria-hidden="true"></i>
                                </h3>
                            </div>
                            <h6 class="card-title mb-2  text-center">Technical Support</h6>
                            <p class="card-text text-center">
                                Dukungan techincal support yang cepat tanggap . Saat ada masalah pada platform ini
                                tim khusus akan segera menanganinya .
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="reviews" style="background-color: #eeeff3;">
        <div class="container">
            <h3 class="text-center">Apa yang mereka bilang ?</h3>
            <div id="underline"></div>
            <div class="row">
                <div class="card-group">
                    <div class="col-sm-3">
                        <div class="card" data-aos="fade-right">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <h1 class="card-title text-muted"><i class="fa fa-user-circle" aria-hidden="true"></i></h1>
                                </div>
                                <h6 class="card-title text-center">Nadya Intan</h6>
                                <h6 class="card-subtitle mb-2 text-warning text-center"><i class="fa fa-star" aria-hidden="true"></i> <span>4.9</span></h6>
                                <p class="card-text text-center">Website yang sangat bermanfaat , sangat menunjang di masa pandemi seperti skrg .</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card" data-aos="fade-right">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <h1 class="card-title text-muted"><i class="fa fa-user-circle" aria-hidden="true"></i></h1>
                                </div>
                                <h6 class="card-title text-center">Budi Arya</h6>
                                <h6 class="card-subtitle mb-2 text-warning text-center"><i class="fa fa-star" aria-hidden="true"></i> <span>4.7</span></h6>
                                <p class="card-text text-center">Fitur nya sangat banyak dan juga desain yang sangat menarik!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card" data-aos="fade-right">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <h1 class="card-title text-muted"><i class="fa fa-user-circle" aria-hidden="true"></i></h1>
                                </div>
                                <h6 class="card-title text-center">Ady Setyo</h6>
                                <h6 class="card-subtitle mb-2 text-warning text-center"><i class="fa fa-star" aria-hidden="true"></i> <span>4.5</span></h6>
                                <p class="card-text text-center">Terimakasih , sangat membantu . Semoga bisa terus dikembangkan dan fitur2 nya ditambah lagi .</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card" data-aos="fade-right">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <h1 class="card-title text-muted"><i class="fa fa-user-circle" aria-hidden="true"></i></h1>
                                </div>
                                <h6 class="card-title text-center">Putri Zaskia</h6>
                                <h6 class="card-subtitle mb-2 text-warning text-center"><i class="fa fa-star" aria-hidden="true"></i> <span>5.0</span></h6>
                                <p class="card-text text-center">Belajar makin semangat , karena semua nya serba otomatis di website ini . TERIMAKASIHH!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="qna">
            <h3><span id="big-title">Q</span>n<span id="big-title">A</span></h3>
            <div id="underline"></div>
            
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left text-dark" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Bagaimana caranya saya mendaftar jadi user ?
                                        <span class="float-right">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                    </h2>
                                </div>
                            
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Pada learning management system BeSmart akun kamu akan di daftarkan oleh superadmin kami , 
                                        jadi kamu hanya tinggal login lalu menggunakan service yang disediakan oleh BeSmart.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed text-dark" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Sebagai siswa , apakah saya bisa membuat sebuah course/pelajaran ?
                                        <span class="float-right">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Untuk role siswa kamu tidak bisa menambahkan sebuah course/pelajaran . Nanti nya kamu akan langsung 
                                        dimasukkan ke course/pelajaran yang sudah ditentukan.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed text-dark" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Apakah BeSmart tersedia untuk platform Android/IOS?
                                        <span class="float-right">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Untuk saat ini BeSmart baru tersedia untuk platform website.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed text-dark" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                        Bagaimana agar saya menjadi superadmin di platform ini?
                                        <span class="float-right">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                    </h2>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Silahkan menghubungi pihak yang memiliki wewenang atas platform ini .
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed text-dark" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                        Fitur apa saja yang didapatkan oleh user dengan role guru?
                                        <span class="float-right">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                    </h2>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Untuk guru kamu bisa menambah course/pelajaran dan juga menambah kelas yang akan dimasukan ke course tersebut , 
                                        guru juga bisa menambah materi dan tugas untuk course/pelajaran tersebut , guru juga bisa melihat hasil pekerjaan 
                                        dari siswa atas tugas-tugas yang sudah diberikan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 mt-3">
                    <h5 class="text-muted">BeSmart</h5>
                    <a href="#" class="text-white h4">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-white h4 ml-3">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-white h4 ml-3">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" class="text-white h4 ml-3">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <span class="text-white"><i class="fas fa-phone-alt mr-2"></i> +628212099283</span>
                        </div>
                        <div class="col-sm-12">
                            <span class="text-white"><i class="fas fa-envelope mr-2"></i> besmart@info.com</span>
                        </div>
                        <div class="col-sm-12">
                            <span class="text-white">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                Jalan Cicalengka Raya no 23 ,<br> Antapani , Bandung
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-3">
                    <h5 class="text-muted">Get Touch</h5>
                    <p class="text-muted">Untuk mengetahui lebih jauh tentang kami , silahkan isi form dibawah ini untuk mengirim pesan kepada kami . </p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Some message" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button" id="button-addon2"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-3">
                    <h5 class="text-muted">Provided By</h5>
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset("img/smk.png") }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="text-muted mb-0">SMK NEGERI 1 CIMAHI </h5>
                            <p class="text-muted">Utama, Kec. Cimahi Selatan, Kota Cimahi, Jawa Barat 40521</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4">
                            <img src="{{ asset("img/RPL.png") }}" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="text-muted mb-0">Rekayasa Perangkat Lunak SMKN 1 CIMAHI</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 2px;background-color: #727272;margin-top: 17px;"></div>
        <div class="row">
            <div class="col-sm-12">
                <p class="text-center mb-0 mt-2 text-muted">&copy; 2021-2022 BeSmart Learning Management System</p>
            </div>
        </div>
    </footer>


    {{-- Bootstrap Javascript --}}
    <script src="{{ asset("js/app.js") }}"></script>

    {{-- Eksternal Library Javascript --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 400
        });
    </script>
</body>
</html>