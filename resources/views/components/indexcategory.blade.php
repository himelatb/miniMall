@if (!empty($category['children']))
<div class="nav-item dropright" style="margin-left: 10px;">
    <button type="button" class="btn d-flex align-items-center justify-content-between w-100">
        <h6 class="m-0 pb-0 pl-0 pt-0">{{ $category['category_name'] }}</h6><i class="fa fa-angle-right dpIn"></i>
    </button>
    <div class="dropdown-menu">
        <x-indexcategories :categories="$category['children']"/>
    </div>
</div>
@else
    <a class="dropdown-item">{{ $category['category_name'] }}</a>
@endif