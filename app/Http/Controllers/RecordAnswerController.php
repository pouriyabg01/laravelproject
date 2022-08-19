<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecordAnswerResource;
use App\Models\RecordAnswer;
use Illuminate\Http\Request;

class RecordAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  RecordAnswerResource::collection(RecordAnswer::all()->where('user_id' , auth()->user()->id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->all() as $key => $value) {
            $data[$key] = $value;
        }
        $answer = RecordAnswer::create([
            'user_id' => auth()->user()->id,
            'question_type' => 'size',
            'answer' => $data
        ]);

        return new RecordAnswerResource($answer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecordAnswer  $recordAnswer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return  RecordAnswerResource::collection(RecordAnswer::all()->where('user_id' , auth()->user()->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecordAnswer  $recordAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(RecordAnswer $recordAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecordAnswer  $recordAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecordAnswer $recordAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecordAnswer  $recordAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecordAnswer $recordAnswer)
    {
        //
    }
}
