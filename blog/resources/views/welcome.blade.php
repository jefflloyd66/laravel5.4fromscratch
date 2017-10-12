<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<ul>
    @foreach ($tasks as $task)
        <li>{{ $task }}</li>
    @endforeach
</ul>
<body>
</body>
</html>