@extends('layouts.dashboard')

@section('sidebar')
    @include('dashboard._sidebar')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {!! session('status') !!}
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning" role="alert">
                {!! session('warning') !!}
            </div>
        @endif

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{$title}}</h1>
        </div>

        <div class="table-responsive mt-5">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Превью</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Автор</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($lists as $list)
                    <tr id="item-{{$list->id}}">
                        <td>{{$list->id}}</td>
                        <td>
                            <a href="{{Storage::url($list->image)}}" target="_blank">
                                <img src="{{Storage::url($list->previous)}}" alt="{{$list->title}}" style="width: 150px; height: 150px;">
                            </a>
                        </td>
                        <td>{{$list->title}}</td>
                        <td>{{$list->authorUser->name}}</td>
                        <td>
                            <a href="{{route('lk.edit', ['id'=>$list->id])}}" class="btn btn-warning text-white">
                                <span data-feather="edit-2"></span>
                            </a>
                            <a href="#" onclick="deleteTodo({{$list->id}})" class="btn btn-danger">
                                <span data-feather="trash"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
