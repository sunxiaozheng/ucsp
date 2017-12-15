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
                    <th>星期一</th>
                    <th>星期二</th>
                    <th>星期三</th>
                    <th>星期四</th>
                    <th>星期五</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arrs as $arr)
                <tr>
                    @foreach ($arr as $k => $v)
                    <td>{{ $arr[$k]['course'] }}-{{ $arr[$k]['teacher'] }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>