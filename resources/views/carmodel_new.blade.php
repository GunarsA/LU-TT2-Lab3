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
    <form method="POST" action={{ action([App\Http\Controllers\CarmodelController::class, 'store']) }}>
        @csrf
        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}">
        <label for='carmodel_name'>Carmodel name</label>
        <input type="text" name="carmodel_name" id="carmodel_name">
        <button type="submit" value="Add">Save</button>
    </form>
</body>
</html>