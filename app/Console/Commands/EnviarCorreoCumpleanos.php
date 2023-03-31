<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Mail\Cumpleanos;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;


class EnviarCorreoCumpleanos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:enviar-correo-cumpleanos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $today = Carbon::now()->format('m-d');

        $users = User::whereRaw("DATE_FORMAT(birthday, '%m-%d') = '$today'")->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new Cumpleanos($user));
        }
    }
}
