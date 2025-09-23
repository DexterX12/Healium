<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function save(Request $request): RedirectResponse
    {
        $dataToValidate = $request->only(['description', 'drug_id']);
        $dataToValidate['user_id'] = auth()->id();
        $commentDataValidated = Comment::validate($dataToValidate);
        Comment::create($commentDataValidated);

        return back()
            ->with('success', 'Comment created successfully');
    }

    public function delete(int $id): RedirectResponse
    {
        $commentToDelete = Comment::findOrFail($id);
        if ($commentToDelete->getUserId() !== auth()->id()) {
            return back()->with('error', 'You are not allowed to delete this comment');
        }
        $commentToDelete->delete();

        return back()
            ->with('success', 'Comment deleted successfully');
    }
}
