@extends('layout/main')
@section('content')
<h3>导入地址</h3>
<div class="panel panel-default">
    <div class="panel-heading">导入地址</div>
    <div class="panel-body">
        <form method="post" action="{{url('ds_ad_add')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-inline" style="margin: 5px">
                <input class="form-control" type="file" name="addresses" required="required">
                <button class="btn btn-default form-control" type="submit">导入地址</button>
            </div>
        </form>
    </div>
</div>
@include('layout/validator')
@include('layout/message')
@stop