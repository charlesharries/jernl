<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Entry::class, 'entry');
    }

    /**
     * Redirect to the calendar page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/calendar');
    }

    /**
     * Show the form for creating a new entry.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $day = new \DateTime(request()->date);

        return view('entries.create')->with(compact('day'));
    }

    /**
     * Store a newly created entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => 'max:255|required',
            'content' => 'required',
            'date' => 'required|date'
        ]);

        $entry = Entry::create($attributes + ['user_id' => auth()->id()]);

        return redirect('/calendar');
    }

    /**
     * Redirect to the entry edit page.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        return redirect('/entries/' . $entry->id . '/edit');
    }

    /**
     * Show the form for editing entries.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry, Request $request)
    {
        return view('entries.edit')->with(compact('entry'));
    }

    /**
     * Update the entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        $attributes = $request->validate([
            'title' => 'max:255|required',
            'content' => 'required'
        ]);

        $entry->update($attributes);

        return redirect('/calendar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        // TODO: implement this.
    }

    /**
     * Browse all entries at once.
     *
     * @return \Illuminate\Http\Response
     */
    public function browse() {
        $entries = Entry::where(['user_id' => auth()->user()->id])
            ->orderBy('date', 'desc')
            ->limit(20)
            ->get();

        return view('browse')->with(compact('entries'));
    }
}
