<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function save_note(Request $request)
    {
        $request->validate([
            'note'      => 'required'
        ]);

        $notes = new Note();
        $notes->title = $request->title;
        $notes->description = $request->description;
        $notes->user_id = Auth::id();
        $notes->save();

        return redirect(route('my_note'))->with('success', 'Note created successfully.');
    }

    public function update_note(Request $request, $id)
    {
        $notes = Note::whereId($id)->first();
        if (empty($notes)) {
            return redirect()->back()->with('error', 'Note not found.');
        }

        $request->validate([
            'note'      => 'required'
        ]);

        $notes->title = $request->title;
        $notes->description = $request->description;
        $notes->user_id = Auth::id();
        $notes->save();

        return redirect(route('my_note'))->with('success', 'Note updated successfully.');
    }

    public function get_notes()
    {
        $note = Note::whereUserId(Auth::id())->get();
        return view('note.my_note', compact('note'));
    }

    public function delete_notes($id)
    {
        $notes = Note::find($id);
        $notes->delete();
        return response()->json(['success' => 1, 'data' => $notes]);
    }
}
