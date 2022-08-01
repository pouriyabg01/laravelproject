<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
//use App\Models\Auth;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class QuestionsController extends Controller
{
    /**
     * Display a listing of the question resource.
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
     * Store a new created question resource in storage.
     * @bodyParam name string required question text.
     * @bodyParam type string required type of question.
     * @bodyParam options string radio button optional answer (array).
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
        if(Auth::user()->is_admin) {
            $validated = Validator::make($request->all(), [
                'name' => 'required',
                'type' => 'required'
            ])->validate();

            $question = Question::create([
                'name' => $request->name,
                'type' => $request->type,
                'options' => $request->options ?? null
            ]);
            return new QuestionResource($question);
        }else{
            return response()->json(403);
        }
    }

    /**
     * Display the specified question resource.
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
     * Update the specified question resource in storage.
     *
     * @bodyParam name string
     * @bodyParam type string
     * @bodyParam options string
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update([
            'name' => $request->input('name') ?? $question->name,
            'type' => $request->input('type') ?? $question->type,
            'options' => $request->input('options') ?? null
        ]);
        return new QuestionResource($question);
    }

    /**
     * Remove the specified question resource from storage.
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
