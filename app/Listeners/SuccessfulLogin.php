<?php

namespace App\Listeners;

use App\Http\Controllers\HomeController;
use App\Models\LogLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SuccessfulLogin
{

    
    public $HomeController;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->HomeController = new HomeController();
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //
        $event->log = new LogLogin();
        $event->log->iduser = Auth::user()->id;
        $event->log->ip_address = $this->HomeController->getRealIP();
        $event->log->browser = $this->HomeController->getBrowser();
        $event->log->so = $this->HomeController->getPlatform();
        $event->log->location = $this->HomeController->getlocation();
        $event->log->save();
    }
}
