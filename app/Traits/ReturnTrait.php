<?php

namespace App\Traits;

trait ReturnTrait
{
    protected function trait($type, $view, $data = null)
    {
        switch ($type) {
            case 'index':
                if ($data) {
                    return view($view . '_index', compact($data));
                } else {
                    return view($view);
                }
                break;

            case 'create':
                if ($data) {
                    return view($view . '_create', compact($data));
                } else {
                    return view($view);
                }
                break;

            case 'show':
                if ($data) {
                    return view($view . '_show', compact($data));
                } else {
                    return view($view);
                }
                break;

            case 'edit':
                if ($data) {
                    return view($view . '_edit', compact($data));
                } else {
                    return view($view);
                }
                break;

            case 'store':
                return redirect()->route();
                break;

            case 'update':
                break;

            case 'destroy':
                break;
        }
    }
}
