<?php
namespace App\Traits;

use App\Models\Answer;

trait AnswerTrait {


    public static function rate($id, $status = 'up'){
        $answer = Answer::where('id', $id)->first();
        $flag = 0;

        if(!$answer)
            return false;

        $oldrate = $answer->rate;
        if($status == 'up')
            $answer->rate = $oldrate + 1;
        else if($status == 'down' && $oldrate > 0)
            $answer->rate = $answer->rate -1;
        else if($status == 'down' && $oldrate == 0)
            $flag = 1;

        if(!$flag)
            $answer->save();

        return $answer;
    }
}

