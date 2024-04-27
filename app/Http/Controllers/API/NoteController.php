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
}
