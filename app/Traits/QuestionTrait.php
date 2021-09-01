<?php
namespace App\Traits;

use App\Models\Question;

trait QuestionTrait {


    public static function rate($id, $status = 'up'){
        $question = Question::where('id', $id)->first();

        if(!$question)
            return false;

        $oldrate = $question->rate;
        if($status == 'up')
            $question->rate = $oldrate + 1;
        else if($status == 'down' && $oldrate > 0){
            $question->rate = $question->rate -1;
        }

        if($oldrate > 0)
            $question->save();

        return $question;
    }
}

