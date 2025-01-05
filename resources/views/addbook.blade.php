
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
    <link rel="stylesheet" href="{{asset('css/addbook.css')}}">
</head>
<body>
<x-app-layout>

    @if(auth()->user()->can('passive'))
        <div class="alert alert-danger">
                Siz bloklangansiz, kitob qosha olmaysiz
        </div>

    @else    
    <form action="{{ route('storebook') }}" method="POST" enctype="multipart/form-data" class="form1">
        @csrf
        <label for="image">Kitoob nomi:</label>
        <input type="text" name="name" id="name">

        <label for="image">Kitob muallifi:</label>
        <input type="text" name="author" id="author">

        <label for="image">Kitob janri:</label>
        <input type="text" name="genre" id="genre">

        <label for="image">Yili</label>
        <input type="number" name="year" id="year" min="1900"  max="2025" placeholder="Yilni kiriting">


        <!-- rasm yuklash -->
        <label for="image">Rasmni qoshish: <i>(Ixtiyoriy)</i></label>
        <input type="file" id="image" name="image" accept="image/*">

        <!-- PDF yuklash -->
        <label for="pdf">Kitobni qo'shish:</label>
        <input type="file" id="pdf" name="pdf" accept="application/pdf" required>

 
        <!-- yuborish button -->
        <button class="sbm-btn"type="submit">Submit</button>
    </form>
    @endif
</body>
</html>
</x-app-layout>    