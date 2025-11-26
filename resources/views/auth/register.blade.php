<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ro`yhatdan O`tish</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Ro`yhatdan o`tish!</h1>
                            </div>
<form class="user" action="/register" method="POST">
    @csrf

    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="text" name="fname" class="form-control form-control-user" id="exampleFirstName"
                   placeholder="Ismingiz" value="{{ old('fname') }}" required>
            @error('fname') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6">
            <input type="text" name="lname" class="form-control form-control-user" id="exampleLastName"
                   placeholder="Familiyangiz" value="{{ old('lname') }}" required>
            @error('lname') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
               placeholder="Email manzilingiz" value="{{ old('email') }}" required>
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <!-- YANGI: Tuman/Shahar tanlash -->
    <div class="form-group">
        <select name="district" class="form-control form-control-user" id="districtSelect" required>
            <option value="" disabled selected>Tuman yoki shaharni tanlang</option>
            <option value="Buxoro shahar">Buxoro shahar</option>
            <option value="Kogon shahar">Kogon shahar</option>
            <option value="Olot tumani">Olot tumani</option>
            <option value="Buxoro tumani">Buxoro tumani</option>
            <option value="Vobkent tumani">Vobkent tumani</option>
            <option value="Gʻijduvon tumani">Gʻijduvon tumani</option>
            <option value="Jondor tumani">Jondor tumani</option>
            <option value="Kogon tumani">Kogon tumani</option>
            <option value="Qorakoʻl tumani">Qorakoʻl tumani</option>
            <option value="Qorovulbozor tumani">Qorovulbozor tumani</option>
            <option value="Peshku tumani">Peshku tumani</option>
            <option value="Romitan tumani">Romitan tumani</option>
            <option value="Shofirkon tumani">Shofirkon tumani</option>
        </select>
        @error('district') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" name="password" class="form-control form-control-user"
                   id="exampleInputPassword" placeholder="Parolingiz" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-sm-6">
            <input type="password" name="password_confirmation" class="form-control form-control-user"
                   id="exampleRepeatPassword" placeholder="Parolni tasdiqlang" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-user btn-block mt-4">
        Ro'yxatdan o'tish
    </button>
</form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/login">Sizda hisob mavjudmi? Kirish!</a>
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