<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuildingResource;
use App\Models\Building;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::with('comments')->get();
        return new BuildingResource($buildings);
    }

    public function show($id)
    {
        $building = Building::with('comments')->firstOrFail($id);
        return new BuildingResource($building);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'location' => 'required|string',
            'image' => 'required|string',
            'lowest_price' => 'required|numeric',
            'highest_price' => 'required|numeric',
            'land_area' => 'required',
            'building_area' => 'required',
            'description' => 'required|string',
        ];

        $input = $request->validate($rules);

        $building = new Building();
        $building->name = $input['name'];
        $building->location = $input['location'];
        $building->image = $input['image'];
        $building->lowest_price = $input['lowest_price'];
        $building->highest_price = $input['highest_price'];
        $building->description = $input['description'];
        $building->land_area = $input['land_area'];
        $building->building_area = $input['building_area'];
        $building->save();

        return response()->json([
            "status" => true,
            'message' => 'Success add building!'
        ]);
    }

    public function addComment(Request $request, $id)
    {
        $rules = [
            'body' => 'required|string',
        ];

        $input = $request->validate($rules);

        $user = auth()->user();

        $comment = new Comment();
        $comment->id = Str::uuid();
        $comment->building_id = $id;
        $comment->user_id = $user->id;
        $comment->body = $input['body'];
        $comment->save();

        return response()->json([
            "status" => true,
            'message' => 'Success add comment!'
        ]);
    }
}
