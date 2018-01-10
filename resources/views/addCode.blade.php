@extends('layout/main')
@section('content')
<h3>增加段号</h3>
<div class="panel panel-default">
    <div class="panel-heading">段号</div>
    <div class="panel-body">
        <form method="post" action="">
            {{csrf_field()}}
            <div class="form-inline" style="margin: 5px">
                <label>请输入段号</label>
                <input class="form-control" type="text" name="Code[start]">-<input class="form-control" type="text" name="Code[end]">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </form>
    </div>
</div>
@include('layout\validator')
@include('layout\message')
@stop