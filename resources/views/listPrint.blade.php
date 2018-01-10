@extends('layout/main')
@section('js')
<script>
    window.onload = function(){
        document.getElementById("ydhInput").value="";
        document.getElementById('ydhInput').focus();
    }
</script>
@stop
@section('content')
<h3>打印电商单</h3>
<div class="panel panel-default">
    <div class="panel-heading">打印</div>
    <div class="panel-body">
        <form method="post" action="{{url('submitPrint')}}">
            {{csrf_field()}}
            <div class="form-inline" style="margin: 5px">
                <label>批次号:</label>
                <label>{{$pici}}</label>
            </div>
            <div class="form-inline" style="margin: 5px">
                <input name="pici" class="hidden" value="{{$pici}}">
                <input id="ydhInput" name="ydh" class="form-control" placeholder="请输入或扫入西游寄运单号" style="width: 260px">
                <button class="btn btn-default form-control">打印面单</button>
            </div>
        </form>
    </div>
</div>
@include('layout\validator')
@include('layout\message')
<div class="panel panel-default">
    <div class="panel-heading">运单数量：{{$yundans->total()}}</div>
    <div class="panel-body">
        <table class="table ">
            <thead>
                <tr>
                    <th class="col-sm-3">西游寄运单号</th>
                    <th class="col-sm-3">快线运单号</th>
                    <th class="col-sm-2">收件人</th>
                    <th class="col-sm-2">重量</th>
                    <th class="col-sm-2">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($yundans as $yundan)
                <tr>
                    <td>{{$yundan->ydh}}</td>
                    <td>{{$yundan->ds_number}}</td>
                    <td>{{$yundan->r_real_name}}</td>
                    <td>{{$yundan->weight}}</td>
                    @if($yundan->isPrinted == 0)
                    <td><a href="{{url('dsPrint',['id'=>$yundan->id])}}"><button class="btn btn-info">打印</button></a></td>
                    @endif
                    @if($yundan->isPrinted == 1)
                    <td><a href="{{url('dsPrint',['id'=>$yundan->id])}}"><button class="btn btn-default">再次打印</button></a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pull-right">
        <div>{{$yundans->links()}}</div>
    </div>
</div>
@stop