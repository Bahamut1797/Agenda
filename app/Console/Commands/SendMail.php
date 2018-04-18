<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Mail;
use App\Mail\ReminderMail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendMail:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email from remainders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $mytime = Carbon::now()->toDateTimeString();
        $date = explode(" " , $mytime);
        
        $reminders = DB::table('reminders')
                       ->where('alarmDate', '<=', $date[0])
                       ->where('alarmTime', '<=', $date[1])
                       ->get();

        if(count($reminders)>0) {
            foreach ($reminders as $reminder) {
                if($reminder->secEmail == null) {
                    Mail::to($reminder->email)
                        ->send(new ReminderMail($reminder));
                } else {
                    Mail::to($reminder->email)
                        ->cc($reminder->secEmail)
                        ->send(new ReminderMail($reminder));
                }

                if ($reminder->archiveIt == true) {
                    $id = DB::table('archive_reminders')->insertGetId(
                        ['userId' => $reminder->userId,
                        'email' => $reminder->email, 
                        'title' => $reminder->title, 
                        'category' => $reminder->category,
                        'description' => $reminder->description, 
                        'isPayment' => $reminder->isPayment, 
                        'amount' => $reminder->amount, 
                        'location' => $reminder->location, 
                        'urlLoc' => $reminder->urlLoc, 
                        'contact' => $reminder->contact, 
                        'custom' => $reminder->custom, 
                        'frecuency' => $reminder->frecuency, 
                        'alarmDate' => $reminder->alarmDate, 
                        'alarmTime' => $reminder->alarmTime, 
                        'secEmail' => $reminder->secEmail]
                    );
                }

                DB::table('reminders')
                    ->where('id', $reminder->id)
                    ->delete();
            }
        }
        
    }
}
