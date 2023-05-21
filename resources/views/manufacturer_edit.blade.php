<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Editing manufacturer {{ $manufacturer->name }}</title>
</head>

<body>
  <h1>Editing manufacturer {{ $manufacturer->name }}</h1>
  @if (count($errors) > 0)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form method="POST"
      action={{ action([App\Http\Controllers\ManufacturerController::class, 'update'], [ 'manufacturer' => $manufacturer]) }}>
      @csrf
      @method('put')
      <label for='name'>Manufacturer name</label>
      <input type="text" name="name" id="name" value="{{ old('name', $manufacturer->name) }}">
      <label for='founded'>Year founded</label>
      <input type="text" name="founded" id="founded"
          value="{{ old('founded', $manufacturer->founded) }}">
      <label for='website'>Website</label>
      <input type="text" name="website" id="website"
          value="{{ old('website', $manufacturer->website) }}">
      <button type="submit" value="Update">Save changes</button>
  </form>
</body>

</html>