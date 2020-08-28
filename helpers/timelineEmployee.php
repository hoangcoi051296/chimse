<?php

use App\Models\Post;
use LaravelFullCalendar\Calendar;
if (!function_exists("timelineEmployee")) {
    function timelineEmployee($employee_id)
    {
        $postEvents=Post::where('employee_id',$employee_id)->where('status','<',5)->get();
        $evenList=[];
        foreach ($postEvents as $postEvent){
            $timeStart=new \DateTime($postEvent->created_at);
            $timeEnd= new \DateTime($postEvent->updated_at);
            $evenList[]=Calendar::event(
                '+>'.$timeStart->format('H:i').'->'.$timeEnd->format('H:i').' :  Làm việc tại '.$postEvent->ward->name.','.$postEvent->district->name,
                true,
                new \DateTime($postEvent->created_at),
                new \DateTime($postEvent->updated_at),
                $postEvent->id,
                [
                    'url' => route('manager.post.details',['id'=>$postEvent->id])
                ]
            );
        }
        $calendar = \Calendar::addEvents($evenList)
            ->setOptions([ //set fullcalendar options
                'firstDay' => 1
            ]);
        return $calendar;
    }
}
