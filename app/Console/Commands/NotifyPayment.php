<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Credit;
use App\Models\Notification;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class NotifyPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea la notificación de pago';

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
     * @return int
     */
    public function handle()
    {
        $today = Carbon::parse(date('Y-m-d'));
        // $today = Carbon::parse(date('Y-m-d 00:00:00', strtotime('2021-05-14 00:00:00'))); // modificable
        $credits = Credit::where('status',true)->get();

        Log::debug('Hoy es '.$today);

        foreach ($credits as $credit) {
            $notifications = Notification::where('credit_id', $credit->id)->count();

            $created_at = Carbon::parse(date('Y-m-d 00:00:00', strtotime($credit->created_at)))->addDays((15 * ($notifications + 1)));
            Log::debug('Siguiente fecha de pago '.$created_at);

            if ($created_at->eq($today)) {
                $fecha_limite = Carbon::parse(date('Y-m-d 00:00:00', strtotime($credit->created_at)))->addDays(30 * $credit->time_Credit);
            
                if($created_at->lte($fecha_limite)){
                    $notification = Notification::create([
                        'title' => 'Aviso de pago',
                        'description' => 'Aviso de pago del credito #'.$credit->num_credit.' correspondiente al '.date('d-m-Y',strtotime($created_at)),
                        'credit_id' => $credit->id
                    ]);
                    Log::debug('La fecha es inferior');
                    Log::debug($notification);
                }
                else{
                    Log::debug('La fecha es superior');
                }
            } else {
                Log::debug('Al dia con los pagos');
            }
            
            

        }
        // Log::debug(Carbon::now());
        //Carbon::parse('2021-03-31 12:38:36')->addDays(20);
    }
}
