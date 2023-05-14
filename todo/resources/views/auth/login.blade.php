@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5 pt-5">
                <form method="post" action="{{route('login')}}">
                    @csrf
                    <img class="mb-4" src="https://bootstrap-5.ru/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Вход в ToDoList</h1>

                    <div class="form-floating mb-2">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">E-mail адрес</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Пароль</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
                    <p class="mt-5 mb-3 text-muted">
                        <a href="{{route('register')}}">Регистрация</a>
                    </p>
                    <p class="mt-5 mb-3 text-muted">&copy; {{ now()->format('Y') }}</p>
                </form>
            </div>
        </div>
    </div>
@endsection
