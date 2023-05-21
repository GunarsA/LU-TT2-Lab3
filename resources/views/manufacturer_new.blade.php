<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New manufacturer in {{ $country->name }}</title>
</head>

<body>
    <h1>New manufacturer in {{ $country->name }}</h1>
    @if (count($errors) > 0)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action={{ action([App\Http\Controllers\ManufacturerController::class, 'store']) }}>
        @csrf
        <input type="hidden" name="country_id" value="{{ $country->id }}">
        <label for='name'>Manufacturer name</label>
        <input type="text" name="name" id="name" value="{{old('name')}}">
        <label for='founded'>Year founded</label>
        <input type="text" name="founded" id="founded" value="{{old('founded')}}">
        <label for='website'>Website</label>
        <input type="text" name="website" id="website" value="{{old('website')}}">
        <button type="submit" value="Add">Save</button>
    </form>
</body>

</html>