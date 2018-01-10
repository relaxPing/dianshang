<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--<link type="text/css" rel="stylesheet" href="css/menu.css" mce_href="css/menu.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--引入css文件-->
    @section('css')
    <link rel="stylesheet" type="text/css" href="css\layout.css">
    <link rel="stylesheet" type="text/css" href="css\pagination.css">
    @show
    <!--控制左侧下拉菜单-->

    @section('js')
    @show
</head>
<body>
<header>
    @section('headPic')
    <img src="imgs/header.jpg" style="width: 100%;height: auto">
    @show
</header>
<div class="container-fluid">
    <div class="row webBody">
        <div class="col-sm-2 sidenav">
            <!--<ul class="list">
                <a href="#" >运单</a>
                <li ><a href="{{ url('yundanManagementS1')}}" class="{{Request::getPathInfo() == 'yundanManagementS1'?'active':''}}">运单管理</a></li>
                <li><a href="{{ url('createYundan')}}" class="{{Request::getPathInfo() == 'createYundan'?'active':''}}">直接下单</a></li>
            </ul>
            <ul class="list">
                <a href="#">财务</a>
                <li><a href="{{url('recordMoneyIn')}}">充值记录</a></li>
                <li><a>消费记录</a></li>
            </ul>
            <ul class="list">
                <a href="#">账号管理</a>
                <li><a href="{{url('memberDetail')}}">我的资料</a></li>
                <li><a>密码修改</a></li>
                <li><a href="{{url('addressManagement')}}">地址簿</a></li>
            </ul>-->
            <ul class="list">
                <a href="{{url('addCode')}}" class="{{Request::getPathInfo()== '/addCode'?'active':''}}">增加段号</a>
                <!--<a href="{{url('importPici')}}" class="{{(Request::getPathInfo()== '/importPici'||Request::getPathInfo()== '/listPrint')?'active':''}}">导入批次</a>-->
                <a href="{{url('importPici')}}" class="{{(Request::getPathInfo()== '/importPici')?'active':''}}">导入批次</a>
                <a href="{{url('searchPici')}}" class="{{Request::getPathInfo()=='/searchPici'||Request::getPathInfo()== '/listPrint'?'active':''}}">查询</a>
                <a href="{{url('export')}}" class="{{Request::getPathInfo()== '/export'?'active':''}}">文件导出</a>
            </ul>
        </div>
        <div class="col-sm-10 content">
            @yield('content')
        </div>
    </div>
</div>
</body>

<footer class="container-fluid text-center">
    <p>@by Ping Xin</p>
</footer>
</html>