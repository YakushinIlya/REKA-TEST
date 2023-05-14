@extends('layouts.dashboard')

@section('sidebar')
    @include('dashboard._sidebar')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{$title}}</h1>
        </div>

        <div class="row">
            <form id="formAddList" method="post" action="{{route('lk.create')}}" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Введите заголовок">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Введите описание"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Выберите изображение</label>
                    <input class="form-control" name="image" type="file" id="image">
                </div>
                <div class="mb-5">
                    <label for="tags" class="form-label">Теги</label>
                    <select class="tags-multiple form-control" id="tags" name="tags[]" multiple="multiple">
                        @foreach($tags as $tag)
                            <option value="{{$tag->title}}">{{$tag->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-info text-white" id="submitFormTodo" type="submit">
                    <span data-feather="save"></span> Сохранить</button>
            </form>
        </div>
    </main>
@endsection
