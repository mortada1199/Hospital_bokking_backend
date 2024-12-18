<?php

namespace App\Notifications;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DelayInInterview extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        

    //    $Bone=  $one['BeginOfPreview'] ?? "";//Begin time of patient one 
    //    $Eone=  $one['endOfPreview'] ?? "" ;//End time of patient one

    //    $Btwo=  $two['BeginOfPreview'] ?? "";//Begin time of patient two
    //    $Etwo=  $two['endOfPreview'] ?? "";//End time of patient two

    //       $result1=(float)$Eone-(float)$Bone;
    //       $result2=(float)$Etwo-(float)$Btwo;
    //       $finalresult = $result1 + $result2;



       
        
          $one  = Patient::find('1') ?? "";//aptient 1
          $two = Patient::find('2') ?? "";//patient 2


          $Bone=  $one['BeginOfPreview'] ?? "";//Begin time of patient one 
           $Eone=  $one['endOfPreview'] ?? "";
 
          $begin = Carbon::parse($Bone);
          $end = Carbon::parse($Eone);
 
           $differenceInSeconds = $end->timestamp - $begin->timestamp;
 
           // Convert the difference to hours, minutes, and seconds
           $differenceInHours = floor($differenceInSeconds / 3600);
            $differenceInMinutes = floor(($differenceInSeconds % 3600) / 60);
           $differenceInSeconds = $differenceInSeconds % 60;

        return (new MailMessage)
                    ->line('Dear, sorry for the delay. The interview will be postponed for a period of:')
                    ->action('Time = '. $differenceInSeconds, '/')
                    ->line('Thank you for your understanding Khartoum Hospital!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
