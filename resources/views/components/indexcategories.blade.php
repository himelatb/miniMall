@if (@isset($categories) && !empty($categories))
    @foreach ($categories as $category)
        <x-indexcategory :category="$category"/>
    @endforeach
@endif

   