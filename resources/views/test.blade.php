<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
    welcome! {{date('Y-m-d H:i:s')}}
    <script language="JavaScript">
        function myrefresh()
        {
            window.location.reload();
        }
        setTimeout('myrefresh()',2000); //指定1秒刷新一次
    </script>
    </body>
</html>
