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
                    <th>击杀</th>
                    <th>死亡</th>
                    <th>助攻</th>
                    <th>输出伤害</th>
                    <th>承受伤害</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $item)
                <tr>
                    <td>{{$item->date}}</td>
                    <td>{{$player[$item->player]}}</td>
                    <td>{{$item->kill}}</td>
                    <td>{{$item->death}}</td>
                    <td>{{$item->assists}}</td>
                    <td>{{$item->out_put_damage}}</td>
                    <td>{{$item->accept_damage}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div><!-- /.blog-main -->
@endsection
