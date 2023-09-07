@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    @if(session('message'))
<div class="todo__alert">
  <div class="todo__ttl">
      <li>{{ session('message') }}</li>
  </div>
    @endif
    @if ($errors->any())
        <div class="todo__alert--danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="todo__main">
    <form class="form__todo" action="/todos" method="POST">
    @csrf
        <div class="form__todo--area"><input class="form__todo--text" type="text" name="content">
        </div>
        <div class="form__button"><button class="form__button--submit" type="submit">作成</button>
        </div>
    </form>
</div>

<div class="todo__list">
    <table class="todo__list--table">
        <tr class="todo__table--up">
            <th class="todo__list--ttl">Todo</th>
        </tr>
        @foreach ($todos as $todo)
        <tr class="todo__list--main">
                    <td class="todo__table--item">
                        <form class="todo__update" action="/todos/update" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="todo__update--item">
                                <input class="todo__update--item--text" type="text" name="content" value="{{ $todo['content'] }}">
                                <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            </div>
                            <div class="todo__update--button">
                                <button class="todo__update--button--inner" type="submit">更新</button>
                            </div>
                        </form>
                    </td>
            <td class="todo-table__item">
                <form class="todo__delete" action="/todos/delete" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="todo__delete--button">
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        <button class="todo__delete--button--inner" type="submit">削除</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
</div>
@endsection
