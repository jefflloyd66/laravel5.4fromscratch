<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<ul>
    @foreach ($tasks as $task)
        <li>
            <a href="/tasks/{{ $task->id }}">{{ $task->body }}</a>
        </li>
    @endforeach
</ul>
<body>
</body>
</html>