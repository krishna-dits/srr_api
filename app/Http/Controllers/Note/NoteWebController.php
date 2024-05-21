<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteWebController extends Controller
{
    public function create(Request $request)
    {
        $notes = Note::whereUserId(Auth::id())->paginate(6);

        if (Request()->isMethod('POST')) {
            $request->validate([
                'description'      => 'required'
            ]);

            $note = new Note();
            $note->title = 'default title';
            $note->description = $request->description;
            $note->user_id = Auth::id();
            $note->save();

            return redirect()->back()->with('success', 'Note created successfully.');
        }

        return view('note.create_update', compact('notes'));
    }

    public function update(Request $request, $id)
    {
        $note = Note::whereId($id)->first();
        if (empty($note)) {
            return redirect()->back()->with('error', 'Note not found.');
        }

        $notes = Note::whereUserId(Auth::id())->paginate(6);

        if (Request()->isMethod('POST')) {
            $request->validate([
                'description'      => 'required'
            ]);

            $note->title = 'default title';
            $note->description = $request->description;
            $note->user_id = Auth::id();
            $note->save();

            return redirect()->back()->with('success', 'Note created successfully.');
        }

        return view('note.create_update', compact('notes', 'note'));
    }

    public function delete_note($id)
    {
        $note = Note::whereId($id)->first();
        if (empty($note)) {
            return redirect()->back()->with('error', 'Note not found.');
        }

        $note->delete();
        return redirect()->back()->with('success', 'Note deleted successfully.');
    }
}
