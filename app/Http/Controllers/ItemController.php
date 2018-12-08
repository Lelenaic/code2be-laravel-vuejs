<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @OA\Get(
     *      path="/items",
     *      operationId="getItemsList",
     *      tags={"Items"},
     *      summary="Get list of items",
     *      description="Get list of items",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *     )
     *
     * Display a listing of the resource.
     *
     * @return Item[]
     */
    public function index()
    {
        return Item::all();
    }

    /**
     *  @OA\Post(
     *      path="/items",
     *      operationId="createItem",
     *      tags={"Items"},
     *      summary="Create an item",
     *      description="Create a new item in database",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="name",
     *          description="Items's name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="price",
     *          description="Item's price in cents",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="isActive",
     *          description="Item's status",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     *
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
     *  @OA\Get(
     *      path="/items/{id}",
     *      operationId="showItem",
     *      tags={"Items"},
     *      summary="Show an items",
     *      description="Show an existing item from the database",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Item's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="The item's ID does not exists."),
     * )
     *
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
     * @OA\Put(
     *      path="/items/{id}",
     *      operationId="updateItem",
     *      tags={"Items"},
     *      summary="Update an item",
     *      description="Update an existing item from the database",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Item's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="Items's name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="price",
     *          description="Item's price in cents",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="isActive",
     *          description="Item's status",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="The item's ID does not exists."),
     * )
     *
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
     * @OA\Delete(
     *      path="/items/{id}",
     *      operationId="deleteItem",
     *      tags={"Items"},
     *      summary="Delete an item",
     *      description="Delete an existing item from ther database",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Item's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="The item's ID does not exists."),
     * )
     *
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
