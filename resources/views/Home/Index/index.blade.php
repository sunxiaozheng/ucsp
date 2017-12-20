<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>课程表</title>
    </head>
    <body>
        <table border="1" style="margin: 0 auto;text-align: center;" width="800" height="800">
            <thead>
                <tr>
                    @for ($i = 0; $i < count($lists[0]); $i++)
                        @switch($i+1)
                            @case(1)
                                <th>星期一</th>
                                @break
                            @case(2)
                                <th>星期二</th>
                                @break
                            @case(3)
                                <th>星期三</th>
                                @break
                            @case(4)
                                <th>星期四</th>
                                @break
                            @case(5)
                                <th>星期五</th>
                                @break
                            @case(6)
                                <th>星期六</th>
                                @break
                            @case(7)
                                <th>星期日</th>
                                @break
                        @endswitch
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $list)
                <tr>
                    @foreach ($list as $k => $v)
                    <td>{{ $list[$k]['course'] }}-{{ $list[$k]['teacher'] }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>