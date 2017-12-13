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
                <tr>
                    @foreach($arrs as $items)
                    @if ($loop->index < 5)
                    <td>{{ $arrs[$loop->index]['course'] }}-{{ $arrs[$loop->index]['teacher'] }}</td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach($arrs as $items)
                    @if ($loop->index >= 5 && $loop->index < 10)
                    <td>{{ $arrs[$loop->index]['course'] }}-{{ $arrs[$loop->index]['teacher'] }}</td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach($arrs as $items)
                    @if ($loop->index >= 10 && $loop->index < 15)
                    <td>{{ $arrs[$loop->index]['course'] }}-{{ $arrs[$loop->index]['teacher'] }}</td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach($arrs as $items)
                    @if ($loop->index >= 15 && $loop->index < 20)
                    <td>{{ $arrs[$loop->index]['course'] }}-{{ $arrs[$loop->index]['teacher'] }}</td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach($arrs as $items)
                    @if ($loop->index >= 20 && $loop->index < 25)
                    <td>{{ $arrs[$loop->index]['course'] }}-{{ $arrs[$loop->index]['teacher'] }}</td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach($arrs as $items)
                    @if ($loop->index >= 25 && $loop->index < 30)
                    <td>{{ $arrs[$loop->index]['course'] }}-{{ $arrs[$loop->index]['teacher'] }}</td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach($arrs as $items)
                    @if ($loop->index >= 30 && $loop->index < 35)
                    <td>{{ $arrs[$loop->index]['course'] }}-{{ $arrs[$loop->index]['teacher'] }}</td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    @foreach($arrs as $items)
                    @if ($loop->index >= 35 && $loop->index < 40)
                    <td>{{ $arrs[$loop->index]['course'] }}-{{ $arrs[$loop->index]['teacher'] }}</td>
                    @endif
                    @endforeach
                </tr>
            </tbody>
        </table>

    </body>
</html>