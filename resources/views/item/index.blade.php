@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
<?php
$type_names = [
    '種別分け',
	'絵本',
	'文庫本',
	'漫画',
	'参考書',
	'雑誌',
];

$statues_names = [
    '在庫の有無',
    '在庫あり',
    '欠品中'
]
?>
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
                <form action="{{ route('items.index') }}" method="GET" class="input-group m-3">
                  <input type="text" name="keyword" value="{{ $keyword }}" placeholder="商品名検索" class="form-control me-3">
                  <div class="input-group-append">
                  </div>
                  <select name="category" data-toggle="select" class="custom-select me-3">
                   
                 
                  @foreach($type_names as $key => $type_name) 
	               <option value="{{ $key == 0 ? '' : $key  }}" {{ $category == $key ? 'selected' : '' }}>{{ $type_name }}</option>
                 @endforeach
                 </select>
                  <select name="status"  data-toggle="select" class="custom-select">
                  @foreach($statues_names as $key => $status_name) 
	               <option value="{{ $key == 0 ? '' : $key  }}" {{ $status == $key ? 'selected' : '' }}>{{ $status_name }}</option>
                 @endforeach
                  </select>
                  <input type="submit" value="検索" class="btn btn-primary me-1" name="search_button">
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
                                    <td>{{ $type_names[ $item->type ] }}
</td>
                                    <td>{{ $item->price.'円' }}</td>
                                    
                                    <td>{{ $item->status > 0 ? '在庫在り' : '欠品中' }}</td>

                                   
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
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@stop

@section('js')
@stop
