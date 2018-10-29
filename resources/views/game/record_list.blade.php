@extends("layout.main")
@section("content")
    <div class="col-sm-8 blog-main">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <caption class="text-center">乱斗四人组-战绩列表</caption>
                <thead>
                <tr>
                    <th>日期</th>
                    <th>选手</th>
                    <th>场数</th>
                    <th>击杀/场</th>
                    <th>死亡/场</th>
                    <th>助攻/场</th>
                    <th>输出伤害/场</th>
                    <th>承受伤害/场</th>
                    <th>MVP值</th>
                </tr>
                </thead>
                <tbody>
                @forelse($list as $item)
                <tr>
                    <td>{{$date}}</td>
                    <td>{{$player[$item['userId']]}}</td>
                    <td>{{$item['count']}}</td>
                    <td>{{$item['kills']}}</td>
                    <td>{{$item['dead']}}</td>
                    <td>{{$item['assistance']}}</td>
                    <td>{{$item['attackDamage']}}</td>
                    <td>{{$item['bearDamage']}}</td>
                    <td style="color: red">{{$item['mvpValue']}}</td>
                </tr>
                @empty
                    <tr style="text-align: center">
                        <td colspan="100" style="color: red">透了,瑞了,今日不斗了</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div><!-- /.blog-main -->
@endsection
