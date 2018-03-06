@extends('layout/main')
@section('content')
<h3>地址管理</h3>
<div class="panel panel-default">
    <div class="panel-heading">
        <a href="{{url('ds_ad_delAll')}}"><button onclick="if(confirm('确定要执行删除吗？注意：删除操作不可恢复！')==false) return false" class="btn btn-danger">删除全部</button></a>
        <a href="{{url('ds_ad_add')}}" class="btn btn-default">导入地址</a>
    </div>
    <div class="panel-body">
        <h4>地址总数：{{$count}}</h4>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>姓名/手机</th>
                    <th>地址</th>
                    <th>发件人/电话</th>
                    <th>发件人地址</th>
                    <!--<th>操作</th>-->
                </tr>
            </thead>
            <tbody>
            @foreach($addresses as $address)
                <tr>
                    <td>{{$address -> seq}}</td>
                    <td>{{$address -> r_name}}<br>{{$address -> r_mobile}}</td>
                    <td>{{$address -> r_address}}</td>
                    <td>{{$address -> s_name}}<br>{{$address -> s_mobile}}</td>
                    <td>{{$address -> s_address}}</td>
                    <!--<td><a href="{{url('ds_del_id',['id' => $address -> id])}}"><button onclick="if(confirm('确定要执行删除吗？注意：删除操作不可恢复！')==false) return false" class="btn btn-danger">删除</button></a></td>-->
                </tr>
            @endforeach
            </tbody>
        </table>

        <!--分页-->
        <div class="pull-right">
            {{$addresses -> render()}}
        </div>
    </div>
</div>
@include('layout/validator')
@include('layout/message')
@stop