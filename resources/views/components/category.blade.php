
    <option value="{{$category['cat_id']}}">{{!empty($category['parent'])? $category['parent']['category_name']." -> ":""}}{{$category['category_name']}}</option>

    <x-categories :categories="$category['children']"/>

