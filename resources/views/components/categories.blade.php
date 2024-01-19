@if(isset($categories) && !empty($categories))
        @foreach($categories as $category)
            <x-category :category="$category"/>
            
        @endforeach
@endif