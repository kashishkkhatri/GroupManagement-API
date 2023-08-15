<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    public function addUserToGroup(Request $request, $groupId, $userId)
    {
        $group = Group::findOrFail($groupId);
        $user = User::findOrFail($userId);

        if ($group->users->contains($user)) {
            return response()->json(['message' => 'User is already associated with the group'], 400);
        }
        $group->users()->attach($user);

        return response()->json(['message' => 'User added to group']);
    }
    public function removeUserFromGroup($groupId, $userId)
    {
        $group = Group::findOrFail($groupId);
        $user = User::findOrFail($userId);

        $group->users()->detach($user);

        return response()->json(['message' => 'User removed from group']);
    }
}
