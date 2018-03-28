<link href="/style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/style/v1/base.css" rel="stylesheet">
<!--    <link href="/style/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">-->
<!--<script src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script src="/style/bootstrap/js/bootstrap.min.js"></script>

<div class="container-fluid" id="tt" >
    <!--占用时间-->
    <table class="table table-bordered table-hover" style="margin-top: 5px;">
        <thead style="background-color: #5ba0c9">
        <tr>
            <th width="300">用户名</th>
            <th width="160">总次数</th>
            <th width="120">结束次数</th>
            <th width="120">次数</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>shanshan</td>
            <td><?=$data['sum']['shanshan'];?></td>
            <td><?=$data['end']['shanshan'];?></td>
            <td><?=$data['sum']['shanshan']-$data['end']['shanshan'];?></td>
        </tr>
        <tr>
            <td>shenxiu</td>
            <td><?=$data['sum']['shenxiu'];?></td>
            <td><?=$data['end']['shenxiu'];?></td>
            <td><?=$data['sum']['shenxiu']-$data['end']['shenxiu'];?></td>
        </tr>
        <tr>
            <td>linini</td>
            <td><?=$data['sum']['lili'];?></td>
            <td><?=$data['end']['lili'];?></td>
            <td><?=$data['sum']['lili']-$data['end']['lili'];?></td>
        </tr>
        </tbody>
    </table>
</div>
