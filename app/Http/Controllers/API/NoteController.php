<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;


class NoteController extends Controller
{
    public function get_notes(){
        return Note::get();
    }

    public function save_notes(Request $request){
        $requestedData = (object)$request->json()->all();
        $notes = new Note();
        $notes->title = $requestedData->title;
        $notes->description = $requestedData->description;
        $notes->user_id = $requestedData->user_id;
        $notes->save();
        return response()->json(['success'=>1, 'data'=>$notes], 200,[],JSON_NUMERIC_CHECK);
    }

    public function update_notes(Request $request){
        $requestedData = (object)$request->json()->all();
        $notes = Note::find($requestedData->id);
        $notes->title = $requestedData->title;
        $notes->description = $requestedData->description;
        $notes->user_id = $requestedData->user_id;
        $notes->update();
        return response()->json(['success'=>1, 'data'=>$notes], 200,[],JSON_NUMERIC_CHECK);
    }

    public function delete_notes($id){
        $notes = Note::find($id);
        $notes->delete();
        return response()->json(['success'=>1, 'data'=>$notes], 200,[],JSON_NUMERIC_CHECK);
    }
}
