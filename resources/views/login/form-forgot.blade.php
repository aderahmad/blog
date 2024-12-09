<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Form Lupa Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body style="background-color:rgba(153,0,204,0.6);">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                {{-- Error Alert --}}

                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Lupa Password</h3>
                                </div>
                                @if (session('error'))
                                    <button class="btn btn-danger btn-block" type="button">{{ session('error') }}
                                    </button>
                                @endif
                                @if (session('success'))
                                    <button class="btn btn-primary btn-block" type="button">{{ session('success') }}
                                    </button>
                                @endif
                                <div class="card-body">
                                <!--  route('forgot.process-forgot')  -->
                                    <form action="{{ route('forgot.process-forgot') }}" method="POST" id="">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <input class="form-control py-4" id="inputEmail" type="email"
                                                name="email" placeholder="Masukkan Email" value="{{old('email')}}"/>
                                            @if ($errors->has('email'))
                                                <span class="error">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary btn-block" type="submit" style="background-color:#9900cc;">Kirim</button>
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-center mt-4 mb-0">
                                            
                                            <a class="small" href="{{ route('login.form-login') }}">kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ url('assets/js/scripts.js') }}"></script>
</body>
</html>