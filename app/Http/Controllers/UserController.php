<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/user",
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
     *      path="/user",
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
     *      path="/user/{id}",
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
     *      path="/user/{id}",
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
     *      path="/user/{id}",
     *      operationId="delteUser",
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
}
