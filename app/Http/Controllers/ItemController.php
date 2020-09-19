<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items', compact('items'));
    }

    public function store( Request $request ) {

        \Validator::make(
            $request->only('item_name'),
            ['item_name' => ['required','unique:items,name']],
            ['item_name.unique' => 'Item already exist in the list']
        )->validate();

        try {
            DB::beginTransaction();

            Item::create(['name' => $request->item_name]);

            DB::commit();

            return response(['message' => 'Item was added successfully'], Response::HTTP_OK);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();

            return response(['message' => 'Something went wrong! Please try again later'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function moveItem(Item $item, Request $request) {
        \Validator::make(
            $request->only('is_selected'),
            ['is_selected' => ['required']],
            ['is_selected.required' => 'Specify the action to be perform']
        )->validate();

        try {
            DB::beginTransaction();

            Item::whereId($item->id)->update(['is_selected' => (boolean)$request->is_selected]);

            DB::commit();

            return response(['message' => 'Item moved successfully'], Response::HTTP_OK);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();

            dd($exception->getMessage());

            return response(['message' => 'Something went wrong! Please try again later'], Response::HTTP_BAD_REQUEST);
        }
    }
}
