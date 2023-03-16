@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('item.search') }}" method="GET" class="input-group m-3">
             　　 <input type="text" name="keyword" value="{{ $keyword }}" placeholder="商品名検索" class="form-control me-3">
              　　<div class="input-group-append">
              　　</div>
              　　<select name="category" value="{{ $category }}" data-toggle="select" class="custom-select me-3">
                　　<option value="">種別分け</option>
               　 　<option value="1">絵本</option>
              　  　<option value="2">文庫本</option>
               　　 <option value="3">漫画</option>
                　　<option value="4">参考書</option>
                　　<option value="5">雑誌</option>
              　　</select>
              　　<select name="status" value="{{ $status }}" data-toggle="select" class="custom-select">
                　　<option value="">在庫の有無</option>
                　　<option value="1">在庫あり</option>
                　　<option value="0">欠品中</option>
             　　　 </select>
              　　　<input type="submit" value="検索" class="btn btn-primary me-2" name="search_button">
            　　</form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>値段</th>
                                <th>ステータス</th>
                                <th>詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->price }}</td>
                                    @if ($item->status == 0)
                                    <td class="nothing">{{$item->statue}}</td>
                                    @else
                                    <td>{{ $item->status }}</td>
                                    @endif
                                    <td>{{ $item->detail }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
