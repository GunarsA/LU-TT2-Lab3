<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Models from {{$manufacturer->name}}</title>
</head>

<body>
    <h1>Models from {{$manufacturer->name}}</h1>
    @if (count($carmodels) == 0)
        <p color='red'>There are no records in the database!</p>
    @else
        <ul>

            @foreach ($carmodels as $carmodel)
                <li>
                   {{ $carmodel->name }}
                </li>
            @endforeach
        </ul>
    @endif
    <a href="{{ action([App\Http\Controllers\CarmodelController::class, 'create'],['manufacturerslug' => $manufacturer->id])}}">Add new carmodel</a>
</body>

</html>