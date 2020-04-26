<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\user;

class HourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email hourly to the admin';

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
        $user = User::select('*')->where('is_admin','=', 1)->get();
        foreach($user as $a){
                Mail::raw("",function($message) use ($a){
                    $message ->from('williams@gmail.com');
                    $message->to($a->email)->subject('admin message goes here');
                });
        }
        $this->info('Admin message has been sent');
    }
}
