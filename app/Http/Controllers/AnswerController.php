<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Answer;
use App\Models\Question;
use App\Traits\AnswerTrait;
use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;

class AnswerController extends Controller
{
    public function all($id){
        return Answer::where('question_id', $id)->paginate(10);
    }

    public function create(AnswerRequest $request){
        try{

            $question = Question::where('id', $request->question_id);

            Answer::create(['question_id' => $request->question_id, 'answer' => $request->answer]);
            return response()->json(['message' => 'Success']);

        }catch(Exception $ex){
            return response()->json(['message' =>'Failed']);
        }
    }

    public function delete($id){
        try{
        $answer = Answer::where('id', $id)->first();
        if(!$answer)
            return response()->json(['message' => 'failed']);

        else
            $answer->delete();

        return response()->json(['message' => 'Success']);
        }catch (\Exception $ex){
            return response()->json(['message' => 'failed']);
        }

    }

    public function rateup($id){
        try{
            $answer = AnswerTrait::rate($id, 'up');
            if(!$answer)
                return response()->json(['message' => 'failed']);

        return response()->json(['message' => 'Success', 'data' => $answer]);
        }catch (\Exception $ex){
            return response()->json(['message' => 'failed']);
        }

    }
    public function ratedown($id){
        try{
            $answer = AnswerTrait::rate($id, 'down');
            if(!$answer)
                return response()->json(['message' => 'failed']);

        return response()->json(['message' => 'Success', 'data' => $answer]);
        }catch (\Exception $ex){
            return response()->json(['message' => 'failed']);
        }

    }
}
