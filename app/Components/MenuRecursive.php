<?php

namespace App\Components;

use App\Models\Menu;

class MenuRecursive
{
    private $html;
    public function __construct()
    {
        $this->html = '';
    }

    public function menuRecusiveAdd($parent_id = 0, $subMark = '')
    {
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $item) {
            $this->html .= "<option value='" . $item->id . "'>" . $subMark . $item->name . "</option>";
            $this->menuRecusiveAdd($item->id, $subMark . '--');

        }
        return $this->html;
    }

    public function menuRecusiveEdit($parentIdMenuEdit, $parent_id = 0, $subMark = '')
    {
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $item) {
            if ($parentIdMenuEdit == $item->id) {
                $this->html .= "<option selected value='" . $item->id . "'>" . $subMark . $item->name . "</option>";
            } else {
                $this->html .= "<option value='" . $item->id . "'>" . $subMark . $item->name . "</option>";
            }

            $this->menuRecusiveEdit($parentIdMenuEdit, $item->id, $subMark . '--');

        }

        return $this->html;
    }
}
