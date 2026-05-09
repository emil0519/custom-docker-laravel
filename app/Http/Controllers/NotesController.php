<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;

class NotesController extends Controller
{
    public function store()
    {
        Note::create();
    }

    public function update(Note $note, NoteRequest $request)
    {
        $note->update($request->noteInfo());
    }

    public function delete(Note $note)
    {
        $note->delete();
    }

    public function index()
    {
        $notes = Note::all();

        return NoteResource::collection($notes);
    }

    public function show(Note $note)
    {
        return NoteResource::make($note);
    }
}
