@php
    namespace App\Http\Controllers\Admin;

    $sub_categories = GetSubCategoriesController::getSubCategories();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scraper</title>
</head>
<body>
    <h1>Let's scrape some data</h1>

    <form action="{{route('scrape.sub_categories')}}" method="post">
        @csrf

        {{-- <div class="form-group">
            <label for="shop">Webshop</label>
            <select name="shop" id="shop">
                @foreach ($shops as $key => $shop)
                    <option value="{{$key}}">{{$shop}}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group">
            <label for="webshop_name">Webshop name</label>
            <input type="text" name="webshop_name" id="webshop_name" placeholder="e.g. bol.com" required>

            <label for="category">Category</label>
            <input type="text" name="category" id="category" placeholder="e.g. verzorging" required>

            <label for="url">Url</label>
            <input type="url" name="url" id="url" placeholder="e.g. https://www.bol.com" required>
        </div>
        <button type="submit">Scrape data !!</button>
    </form>


    <table>
        @foreach ($sub_categories as $sub_category)
            <tr>
                <td>{{$sub_category->name}}</td>
                <td>
                    <form method="post" action="{{route('scrape.articles')}}">
                        @csrf
                        <input type="hidden" name="url" value="{{$sub_category->url}}">
                        <input type="hidden" name="shop" value="{{$sub_category->shop}}">
                        {{-- <input type="hidden" name="sub-category-id" value="{{$sub_category->id}}"> --}}
                        <button type="submit">Scrape all items</button>
                    </form>
                </td>
            </tr>

        @endforeach
    </table>

</body>
</html>
