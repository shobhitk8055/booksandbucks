<?php

namespace AvoRed\Framework\System\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Support\Facades\Menu;
use Illuminate\Support\Facades\Route;

class LayoutComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $routeName = Route::currentRouteName();

        [$currentOpenKey, $currentMenuItemKey] = Menu::getMenuItemFromRouteName($routeName);
        $genres = (object) ['name'=>'Genres',
            'icon'=>'ticket',
            'url'=>'#',
            'submenus'=> [
                'all_genre'=>[
                    'name'=>'All Genre',
                    'url'=>'http:\/\/127.0.0.1:8000\admin\genre'
                ],
                'add_genre'=>[
                    'name'=>'Add Genre',
                    'url'=>'http:\/\/127.0.0.1:8000\admin\genre\create'
                ]
            ]
        ];
        $offers = (object) ['name'=>'Offers',
            'icon'=>'wallet',
            'url'=>'#',
            'submenus'=> [
                'all_offers'=>[
                    'name'=>'All Offers',
                    'url'=>'http:\/\/127.0.0.1:8000\admin\offers'
                ],
                'add_offer'=>[
                    'name'=>'Add Offer',
                    'url'=>'http:\/\/127.0.0.1:8000\admin\offer\create'
                ]
            ]
        ];
        
        $adminMenus = Menu::adminMenus();
        // dd($adminMenus);
        $view->with('adminMenus', $adminMenus)
            ->with('currentOpenKey', $currentOpenKey)
            ->with('genres', $genres)
            ->with('offers', $offers)
            ->with('currentMenuItemKey', $currentMenuItemKey);
    }
}