<?php
namespace App\Traits;

use App\Models\Question;

trait QuestionTrait {


    public static function rate($id, $status = 'up'){
        $flag = 0;

        $question = Question::where('id', $id)->first();

        if(!$question)
            return false;

        $oldrate = $question->rate;
        if($status == 'up')
            $question->rate = $oldrate + 1;
        else if($status == 'down' && $oldrate > 0){
            $question->rate = $question->rate -1;
        }
        else if($status == 'down' && $oldrate == 0)
            $flag = 1;

        if(!$flag)
            $question->save();


        return $question;
    }
}

