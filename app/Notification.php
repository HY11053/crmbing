<?php
/**
 * Created by PhpStorm.
 * User: liang
 * Date: 2017/3/8
 * Time: 13:34
 */

namespace App;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Notification
{
    /**退单通知
     * @return array
     */
    public function ReturnedNotications()
    {
        $returnedNotication=array();
        foreach (Auth::user()->unreadNotifications as $notification) {
            if (class_basename($notification->type)=='ReturnedNotification'){
                $returnedNotication[]=$notification->data;
            }
        }
        return  $returnedNotication;
    }

    /**客服接待通知
     * @return mixed
     */
    public function ReceivedNotications()
    {
        $receivedNotification=array();
        foreach (Auth::user()->unreadNotifications as $notification) {
            if (class_basename($notification->type)=='ReceivedNotification'){
                $receivedNotification[]=$notification;
            }
        }
        return $receivedNotification;
    }

    public function VisitedNotications()
    {
        $visitedNotication=array();
        foreach (Auth::user()->unreadNotifications as $notification) {
            if (class_basename($notification->type)=='VisitedNotification'){
                $visitedNotication[]=$notification;
            }
        }
        return$visitedNotication;
    }

    function Allnotifications (){
        $allnotifications=array();
        foreach (Auth::user()->unreadNotifications as $notification) {
                $allnotifications[]=$notification;
        }
       return $allnotifications;
    }
    /*public function taskNotification()
    {
        $articleUsers=array_unique(::where('created_at','>',Carbon::today())->where('created_at','<',Carbon::now())->pluck('write')->toArray());
        $colorStyle=['aqua','green','blue','red','yellow'];
        $labelStyle=['label-danger','label-info','label-warning','label-success','label-primary','label-default'];
        $taskDatas=['articleUsers'=>$articleUsers,'colorStyle'=>$colorStyle,'labelStyle'=>$labelStyle];
       return $taskDatas;
    }*/

}