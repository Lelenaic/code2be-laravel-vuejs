<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/users",
     *      operationId="getUsersList",
     *      tags={"Users"},
     *      summary="Get list of users",
     *      description="Get list of users",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *     )
     *
     * Display a listing of the resource.
     *
     * @return User[]
     */
    public function index()
    {
        return User::all();
    }

    /**
     *  @OA\Post(
     *      path="/users",
     *      operationId="createUser",
     *      tags={"Users"},
     *      summary="Create an user",
     *      description="Create a new user in database",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="name",
     *          description="User's name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="User's email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=422, description="Given email already exists for another user."),
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param Request $r
     * @return User
     */
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);
        $user = new User();
        $user->name = $r->name;
        $user->email = $r->email;
        $user->save();
        return $user;
    }

    /**
     * @OA\Get(
     *      path="/users/{id}",
     *      operationId="showUser",
     *      tags={"Users"},
     *      summary="Show an user",
     *      description="Show an existing user from the database",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="id",
     *          description="User's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="The user's ID does not exists."),
     * )
     *
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return User
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * @OA\Put(
     *      path="/users/{id}",
     *      operationId="updateUser",
     *      tags={"Users"},
     *      summary="Update an user",
     *      description="Update an existing user from the database",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="id",
     *          description="User's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="User's name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="User's email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="The user's ID does not exists."),
     * )
     *
     * Update the specified resource in storage.
     *
     * @param Request $r
     * @param  \App\User $user
     * @return User
     */
    public function update(Request $r, User $user)
    {
        $r->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $user->name = $r->name;
        $user->email = $r->email;
        $user->save();
        return $user;
    }

    /**
     * @OA\Delete(
     *      path="/users/{id}",
     *      operationId="deleteUser",
     *      tags={"Users"},
     *      summary="Delete an user",
     *      description="Delete an existing user from ther database",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="id",
     *          description="User's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="The user's ID does not exists."),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return void
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    /**
     * @OA\Get(
     *      path="/users/{id}/items",
     *      operationId="getUsersItems",
     *      tags={"User's items"},
     *      summary="Get user's items",
     *      description="Get list of user's items",
     *      @OA\Parameter(
     *          name="id",
     *          description="User's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function listItems(User $user) {
        return $user->items;
    }

    /**
     * @OA\Post(
     *      path="/users/{userId}/items",
     *      operationId="addUsersItems",
     *      tags={"User's items"},
     *      summary="Add an item to the user",
     *      description="Add an item to the user",
     *      @OA\Parameter(
     *          name="userId",
     *          description="User's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="item",
     *          description="Item's id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="quantity",
     *          description="Item's quantity",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *     )
     *
     * Assign new item to user
     *
     * @param Request $r
     * @return void
     */
    public function addItem(Request $r, User $user) {
        $r->validate([
            'item' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1'
        ]);
        $item = Item::find($r->item);
        $user->items()->attach($item, ['quantity' => $r->quantity]);
    }

    /**
     * @OA\Delete(
     *      path="/users/{userId}/items/{itemId}",
     *      operationId="removeUsersItem",
     *      tags={"User's items"},
     *      summary="Remove an item from the user's cart",
     *      description="Remove an item from the user's cart",
     *      @OA\Parameter(
     *          name="userId",
     *          description="User's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="itemId",
     *          description="Item's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *     )
     *
     * Remove item from user's cart
     *
     * @param User $user
     * @param Item $item
     * @return void
     */
    public function dropItem(User $user, Item $item) {
        $user->items()->detach($item);
    }

    /**
     * @OA\Put(
     *      path="/users/{userId}/items/{itemId}",
     *      operationId="updateUsersItems",
     *      tags={"User's items"},
     *      summary="Update an user's item",
     *      description="Update an user's item",
     *      @OA\Parameter(
     *          name="userId",
     *          description="User's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="itemId",
     *          description="Item's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="quantity",
     *          description="Item's quantity",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *     )
     *
     * Assign new item to user
     *
     * @param Request $r
     * @return void
     */
    public function updateItem(Request $r, User $user, Item $item) {
        $r->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        $user->items()->detach($item);
        $user->items()->attach($item, ['quantity' => $r->quantity]);
    }
}
