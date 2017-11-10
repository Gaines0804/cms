<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <foreach from="$data" key='$key' value="$d">
        <h1>{{$d['catname']}}</h1>

        <foreach from="$d['_data']" key="$m" value="$s">
        <h2>|-----{{$s['catname']}}</h2>

            <foreach from="$s['_data']" key="$n" value="$x">
            <h3>------|-----{{$x['catname']}}</h3>

            </foreach>
        </foreach>
    </foreach>
</body>
</html>