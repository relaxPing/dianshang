@extends('layout/main')
@section('content')
<h3>查询批次</h3>
<div class="panel panel-default">
    <div class="panel-heading">查询</div>
    <div class="panel-body">
        <form method="post" action="listPrint">
            {{csrf_field()}}
            <div class="form-inline" style="margin: 5px">
                <input name="pici" class="form-control" placeholder="请输入批次号" style="width: 260px">
                <button type="submit" class="btn btn-default form-control">查询该批次</button>
            </div>
        </form>
    </div>
</div>
@include('layout/validator')
@include('layout/message')
@stop