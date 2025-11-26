<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kirish</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
.alert {
    border: none;
    border-radius: 12px;
    font-size: 0.95rem;
}
.alert-success {
    background: linear-gradient(135deg, #d4edda, #c8e6c9) !important;
    color: #155724;
}
.alert-danger {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb) !important;
    color: #721c24;
}
.form-control.is-invalid {
    border-color: 2px solid #e74a3b;
}
</style>

</head>

<body class="bg-gradient-primary">

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Kirish!</h1>
                                </div>

                                <!-- SUCCESS MESSAGE -->
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <strong>Muvaffaqiyat!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <!-- ERROR MESSAGE (umumiy xato) -->
                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Xato!</strong> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <!-- VALIDATION XATOLAR (email yoki parol noto‘g‘ri bo‘lsa) -->
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <i class="fas fa-times-circle me-2"></i>
                                        <strong>Iltimos, quyidagi xatolarni tuzating:</strong>
                                        <ul class="mt-2 mb-0 ps-4">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <!-- Login Form -->
                                <form class="user" action="/login" method="POST">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <input type="email" 
                                               name="email" 
                                               class="form-control form-control-user @error('email') is-invalid @enderror"
                                               id="exampleInputEmail" 
                                               aria-describedby="emailHelp"
                                               placeholder="Email manzilingizni kiriting..."
                                               value="{{ old('email') }}"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="password" 
                                               name="password" 
                                               class="form-control form-control-user @error('password') is-invalid @enderror"
                                               id="exampleInputPassword" 
                                               placeholder="Parolingizni kiriting..."
                                               required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                            <label class="custom-control-label" for="customCheck">Eslab qolish</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Kirish
                                    </button>
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="/register">Hisob yaratish!</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>