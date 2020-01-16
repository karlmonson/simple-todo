<?php

namespace App\Http\Controllers;

use Auth;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function list($status = null)
    {
    	$user = Auth::user();

    	if(! $status) {
    		return Item::where('user_id', '=', $user->id)->pending()->orderBy('created_at')->get();
    	} elseif($status == 'complete') {
    		return Item::where('user_id', '=', $user->id)->complete()->orderBy('created_at')->get();
    	}
    }

    public function store(Request $request)
    {
    	$data = $request->validate([
    		'title' => 'required|string|max:255',
    	]);

    	$user = Auth::user();
    	$user->items()->create([
    		'title' => $data['title'],
    		'status' => 'pending'
    	]);
    }

    public function complete($id)
    {
    	$user = Auth::user();
    	$item = $user->items->filter(function($item) use($id) {
    		return $item->id == $id;
    	})->first();

    	$item->status = 'complete';
    	$item->save();
    }
}
