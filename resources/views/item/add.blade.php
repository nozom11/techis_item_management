@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" required>
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <input type="number" class="form-control" id="type" name="type" placeholder="1:絵本, 2:文庫本, 3:漫画, 4:参考書,5:雑誌" required>
                        </div>

                        <div class="form-group">
                            <label for="price">値段</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="-----円" required>
                        </div>

                        <div class="form-group">
                            <label for="statue">ステータス</label>
                            <select name="status"  data-toggle="select" class="custom-select">
    
                             <option value="1">在庫あり</option>
                             <option value="0">欠品中</option>
                            </select>
                            
                            
                           
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
