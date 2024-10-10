<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FinFinder | Dashboard</title>
    
</head>

<body>

    <h1>Hello, {{ Auth::user()->username }}</h1>

    <a class="list-group-item logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-red-500">
                <i class="fa-solid fa-door-open"></i>
                Log Out
            </button>
        </form>
    </a>

</body>

</html>
