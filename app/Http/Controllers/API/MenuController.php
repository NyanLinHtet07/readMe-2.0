<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Requests\storeMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all() -> toArray();
        return array_reverse($menus);
    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeMenuRequest $request)
    {
       
        $menu = Menu::create([
            'title' => $request -> title,
            'description' => $request -> description
        ]);

        $menu -> save();

        return response() -> json('Successfully Uploaded Menu');
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
            'menu' => 'nulllable',
            'description' => 'nullable'
        ]);

        $menu = Menu::find($id);
        $menu -> update($request -> only('menu', 'description'));

        return response() -> json('Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);
        $menu -> delete();

        return response() -> json('Menu deleted');
    }
}
