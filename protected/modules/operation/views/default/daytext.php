<div class="container-fluid">
    <div class="page-header sp-title">
        <h1 class="text-center">每日一言<small></small></h1>
    </div>
</div>


<div class="container-fluid">


    <form action="dayText" method="post">
        我的名言: <input type="text" name="text" style="width: 500px;" maxlength="100">
        <input type="submit">
    </form>
<br>
    <table class="table table-bordered">
        <tr>
            <td width="50px">ID</td>
            <td><span class="label label-success">名言</span></td>
        </tr>
        <?php
            foreach($model as $key=>$val)
            {
                echo "<tr><td>".$val["id"]."</td><td>".$val["text"]."</td></tr>";
            }
        ?>
    </table>



</div>
