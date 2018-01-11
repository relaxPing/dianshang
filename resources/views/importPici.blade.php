@extends('layout/main')
@section('content')
<h3>导入批次</h3>
<div class="panel panel-default">
    <div class="panel-heading">剩余电商号：{{$dsCount}}</div>
    <div class="panel-body">
        <form method="post" action="{{url('upload')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-inline" style="margin: 5px">
                <input class="form-control" name="dsNumber" placeholder="请输入地址号" style="width: 150px" value="{{old('dsNumber')}}">
                <input class="form-control" type="file" name="piciExcel" value="{{old('piciExcel')}}"></input>
                <button class="btn btn-default form-control" type="submit">导入该批次</button>
            </div>
        </form>
    </div>
</div>
@include('layout/validator')
@include('layout/message')
@stop