<?php

namespace App\Services;

use App\Models\NewItem;
use Illuminate\Http\Request;
use Validator;

class NewItemService
{

    public function __construct()
    {
    }


    public function index()
    {
        $newItems = NewItem::where('published', 1)
            ->with('category')
            ->withCount('comments')
            ->orderByDesc('publish_at')
            ->paginate(10);

        return view('new-items.index', compact('newItems'));
    }

    public function comments($id)
    {
        $newItem = NewItem::with('category', 'comments')->findOrFail($id);
        return view('new-items.comments', compact('newItem'));
    }

    public function validate(Request $request)
    {
        return Validator::make($request->all(), [
            'comment' => 'required|min:3',
        ])->validate();

    }

    public function newComment(Request $request, $id)
    {
        //validate the request
        $this->validate($request);

        $newItem = NewItem::findOrFail($id);

        $newItem->comments()->create([
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('news.comments', $newItem->id)->with('success', 'Comment added successfully!');
    }
}
