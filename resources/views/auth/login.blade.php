@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-4 px-5">
                <p class="mb-3 fs-3 text-primarys">Login | LaH?shop</p>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="exampleInputEmail1 text-primarys" name="email" aria-describedby="emailHelp" required
                            placeholder="Name@gmail.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="position-relative">
                            <input type="password"
                                class="form-control text-primarys @error('password') is-invalid @enderror"
                                id="exampleInputPassword1" name="password" required placeholder="************">
                            <span class="position-absolute end-0 top-0 pt-2 pe-2" style="cursor: pointer">
                                <i class="bi bi-eye-slash" id="toggle-password"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-secondarys">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const togglePassword = document.querySelector("#toggle-password");
        const password = document.querySelector("#exampleInputPassword1");

        togglePassword.addEventListener("click", function() {
            const type = password.getAttribute("type")
            if (type === "password") {
                password.setAttribute("type", "text")
                togglePassword.classList.remove("bi-eye-slash")
                togglePassword.classList.add("bi-eye")
            } else {
                password.setAttribute("type", "password")
                togglePassword.classList.remove("bi-eye")
                togglePassword.classList.add("bi-eye-slash")
            }

        });
    </script>
@endsection
