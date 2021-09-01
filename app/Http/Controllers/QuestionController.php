<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Traits\QuestionTrait;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    use QuestionTrait;

    public function all(){
        return Question::paginate(10);
    }

    public function create(QuestionRequest $request){
        try {
            Question::create($request->all());
            return response()->json(['message' => 'Success']);
        }catch(Exception $ex){
            return response()->json(['message' =>'Failed']);
        }

    }

    public function delete($id){
        try{
        $question = Question::where('id', $id)->first();
        if(!$question)
            return response()->json(['message' => 'failed']);

        else
            $question->delete();

        return response()->json(['message' => 'Success']);
        }catch (\Exception $ex){
            return response()->json(['message' => 'failed']);
        }

    }

    public function rateup($id){
        try{
            $question = QuestionTrait::rate($id, 'up');
            if(!$question)
                return response()->json(['message' => 'failed']);

        return response()->json(['message' => 'Success', 'data' => $question]);
        }catch (\Exception $ex){
            return response()->json(['message' => 'failed']);
        }

    }
    public function ratedown($id){
        try{
            $question = QuestionTrait::rate($id, 'down');
            if(!$question)
                return response()->json(['message' => 'failed']);

        return response()->json(['message' => 'Success', 'data' => $question]);
        }catch (\Exception $ex){
            return response()->json(['message' => 'failed']);
        }

    }
}
