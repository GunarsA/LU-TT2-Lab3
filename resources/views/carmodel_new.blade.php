<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New manufacturer by {{ $manufacturer->name }}</title>
</head>

<body>
    <h1>New manufacturer by {{ $manufacturer->name }}</h1>
    @if (count($errors) > 0)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action={{ action([App\Http\Controllers\CarmodelController::class, 'store']) }}>
        @csrf
        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}">
        <label for='name'>Carmodel name</label>
        <input type="text" name="name" id="name" value="{{old('name')}}">
        <label for='production_started'>Production started</label>
        <input type="number" name="production_started" id="production_started" value="{{old('production_started')}}">
        <label for='min_price'>Min price</label>
        <input type="number" name="min_price" id="min_price" value="{{old('min_price')}}">
        <button type="submit" value="Add">Save</button>
    </form>
</body>
</html>