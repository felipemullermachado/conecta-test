<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function index()
  {
    return response()->json(User::all(), 200);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return response()->json($user, 201);
  }

  public function show($id)
  {
    $user = User::find($id);

    if (is_null($user)) {
      return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json($user, 200);
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);

    if (is_null($user)) {
      return response()->json(['message' => 'User not found'], 404);
    }

    $validator = Validator::make($request->all(), [
      'name' => 'sometimes|required|string|max:255',
      'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
      'password' => 'sometimes|required|string|min:8',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    $user->update($request->all());

    return response()->json($user, 200);
  }

  public function destroy($id)
  {
    $user = User::find($id);

    if (is_null($user)) {
      return response()->json(['message' => 'User not found'], 404);
    }

    $user->delete();

    return response()->json(null, 204);
  }
}