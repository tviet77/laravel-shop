<?php
namespace App\Helpers;

use App\Models\Category;


function renderCategory($categories, $parentId = 0)
{
    $html = '';
    $children = $categories->where('parent_id', $parentId); // Tìm danh mục con

    if ($children->isNotEmpty()) { // Kiểm tra trước khi mở thẻ <ul>
        $html .= '<ul class="dropdown">';

        foreach ($children as $category) {
            $hasChildrenClass = $categories->where('parent_id', $category->id)->isNotEmpty() ? 'has-children' : '';

            $html .= '<li class="' . $hasChildrenClass . '">';
//            $html .= '<a href="' . $category->slug . '">' . $category->name . '</a>';
            $html .= '<a href="' . route('product-category', ['slug' => $category->slug]) . '">' . $category->name . '</a>';
            $html .= renderCategory($categories, $category->id); // Gọi đệ quy
            $html .= '</li>';
        }

        $html .= '</ul>';
    }

    return $html;
}
