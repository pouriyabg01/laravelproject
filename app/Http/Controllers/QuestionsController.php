<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionResource::collection(Question::all());
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
     * Store a newly created question resource in storage.
     * @bodyParam name string required
     * @bodyParam type string required
     * @bodyParam options string
     * @apiResource App\Http\Resources\QuestionResource
     * @apiResourceModel App\Models\Question
     *
     * @param Question $question
     * @param  \Illuminate\Http\Request  $request
     * @return QuestionResource
     *
     */
    public function store(Request $request)
    {
            $validated = Validator::make($request->all() , [
                'name' => 'required',
                'type' => 'required'
            ])->validate();

            $question = Question::create([
                'name' => $request->name,
                'type' => $request->type,
                'options' => $request->options ?? null
            ]);
            return new QuestionResource($question);
    }

    /**
     * Display the specified resource.
     * @urlParam id int required
     * @apiResource App\Http\Resources\QuestionResource
     * @apiResourceModel App\Models\Question
     *
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request , Question $question)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update([
            'name' => $request->input('name'),
            'options' => $request->input('options') ?? null
        ]);
        return new QuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response(null , 204);
    }
}
