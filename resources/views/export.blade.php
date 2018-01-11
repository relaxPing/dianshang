@extends('layout/main')
@section('content')
<h3>导出报表</h3>
<div class="panel panel-default">
    <div class="panel-heading">导出</div>
    <div class="panel-body">
        <form method="post" action="{{url('export')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-inline" style="margin: 5px">
                <input class="form-control" name="piciNumber" placeholder="请输入批次号" style="width: 150px" value="{{old('piciNumber')}}">
                <button class="btn btn-default form-control" type="submit">导出电商快线报表</button>
            </div>
        </form>
    </div>
</div>
@include('layout/validator')
@include('layout/message')
@stop