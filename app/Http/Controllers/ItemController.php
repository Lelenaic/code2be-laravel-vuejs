<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Item[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Item::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $r
     * @return Item
     */
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'isActive' => 'required|boolean',
        ]);
        $item = new Item();
        $item->name = $r->name;
        $item->price = $r->price;
        $item->isActive = $r->isActive;
        $item->save();
        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return Item
     */
    public function show(Item $item)
    {
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $r
     * @param Item $item
     * @return Item
     */
    public function update(Request $r, Item $item)
    {
        $r->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'isActive' => 'required|boolean',
        ]);
        $item->name = $r->name;
        $item->price = $r->price;
        $item->isActive = $r->isActive;
        $item->save();
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return void
     * @throws \Exception
     */
    public function destroy(Item $item)
    {
        $item->delete();
    }
}
