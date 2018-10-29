@extends("layout.main")
<style>
    .J_date {
        width: 140px;
    }

    .input_field {
        width: 70px;
    }
</style>
<script src="{{URL::asset('js/lib/laydate/laydate.js')}}"></script>
@section("content")
    <div class="col-sm-8 blog-main">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <caption class="text-center">乱斗四人组-战绩录入</caption>
                <thead>
                <tr>
                    <th>日期</th>
                    <th><input type="text" class="J_date" value="{{$today}}"></th>
                    <th>选手</th>
                    <th colspan="3">
                        <select class="form-control person">
                            <option value="">请选择</option>
                            @foreach($player as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </th>
                </tr>
                <tr>
                    <th>击杀</th>
                    <th>死亡</th>
                    <th>助攻</th>
                    <th>输出伤害</th>
                    <th>承受伤害</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody class="J_recordBody">
                <tr>
                    <td><input type="number" class="number input_field kill"></td>
                    <td><input type="number" class="input_field death"></td>
                    <td><input type="number" class="input_field assists"></td>
                    <td><input type="number" class="input_field out_put_damage"></td>
                    <td><input type="number" class="input_field accept_damage"></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm J_delRow">删除</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <p>
                <button type="button" class="btn btn-primary J_addRow">新增一行</button>
                <button type="button" class="btn btn-success J_save">保存</button>
            </p>
        </div>

    </div><!-- /.blog-main -->

    <script>
        //执行一个laydate实例
        laydate.render({
            elem: '.J_date' //指定元素
        });
        $(function () {
            // 新增一行
            $('.J_addRow').click(function () {
                var add_html = '';
                add_html += '<tr>';
                add_html += '<td><input type="number" class="number input_field kill" ></td>';
                add_html += '<td><input type="number" class="input_field death" ></td>';
                add_html += '<td><input type="number" class="input_field assists" ></td>';
                add_html += '<td><input type="number" class="input_field out_put_damage" ></td>';
                add_html += '<td><input type="number" class="input_field accept_damage" ></td>';
                add_html += '<td><button type="button" class="btn btn-danger btn-sm J_delRow">删除</button></td>';
                add_html += '</tr>';
                $('.J_recordBody').append(add_html);
            });

            // 删除当前行
            $(document).on("click", '.J_delRow', function () {
                $(this).parents('tr').remove();
            });

            // 提交数据
            $('.J_save').click(function () {
                var kill_data = [];
                var death_data = [];
                var assists_data = [];
                var out_put_damage_data = [];
                var accept_damage_data = [];
                $(".kill").each(function () {
                    kill_data.push($(this).val());
                });
                $(".death").each(function () {
                    death_data.push($(this).val());
                });
                $(".assists").each(function () {
                    assists_data.push($(this).val());
                });
                $(".out_put_damage").each(function () {
                    out_put_damage_data.push($(this).val());
                });
                $(".accept_damage").each(function () {
                    accept_damage_data.push($(this).val());
                });

                var date = $('.J_date').val();
                var person = $('.person option:selected').val();
                if(person == ''){
                    alert('请选择选手!');
                    return false;
                }
                var games = new Object();
                var length = kill_data.length;
                for (var k = 0; k < length; k++) {
                    var tmpObj = new Object();
                    tmpObj.kill_data = kill_data[k];
                    tmpObj.death_data = death_data[k];
                    tmpObj.assists_data = assists_data[k];
                    tmpObj.out_put_damage_data = out_put_damage_data[k];
                    tmpObj.accept_damage_data = accept_damage_data[k];
                    games[k] = tmpObj;
                }

                $.ajax({
                    url:"{{$postUrl}}",
                    data:{
                        games:games,
                        date:date,
                        person:person
                    },
                    type:'post',
                    dataType:'json',
                    success:function (data) {
                        if(data.code == 200){
                            location.reload();
                        }else{
                            alert(data.msg);
                            return false;
                        }
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })
            })

        })


    </script>
@endsection
