<?php

namespace App\Http\Controllers;

use App\Models\DescriptiveAnswer;
use Illuminate\Http\Request;
use App\Http\Resources\DesAnswerResource;
use Illuminate\Support\Facades\Validator;

class DesAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DesAnswerResource::collection(DescriptiveAnswer::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validated = Validator::make($request->all(), [
//            'question_id' => 'required',
//            'answer' => 'required'
//        ])->validate();

        foreach($request->all() as $key => $value) {
            $desAnswer = DescriptiveAnswer::create([
                'user_id' => auth()->user()->id,
                'question_id' => $key,
                'answer' => $value
            ]);
        }

        if($desAnswer)
            return DesAnswerResource::collection(DescriptiveAnswer::all()->where('user_id' , auth()->user()->id));

        return response()->json('error');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DescriptiveAnswer  $descriptiveAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(DescriptiveAnswer $descriptiveAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DescriptiveAnswer  $descriptiveAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(DescriptiveAnswer $descriptiveAnswer)
    {
        //
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\DescriptiveAnswer  $descriptiveAnswer
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, DescriptiveAnswer $descriptiveAnswer)
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DescriptiveAnswer  $descriptiveAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(DescriptiveAnswer $descriptiveAnswer)
    {
        //
    }
}
