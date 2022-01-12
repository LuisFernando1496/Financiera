<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Credit;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use View;

class NotificationController extends Controller
{
    protected $notifications;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->notifications = Notification::all();
        View::share('notifications', $this->notifications);
    }

    public function mainView()
    {
        return view(
            'back.dashboard.index',
            [
                'activeClients' => $this->getActiveClients(), 'inactiveClients' => $this->getInactiveClients(),
                'authorizedCredits' => $this->getAuthorizedCredits(), 'unauthorizedCredits' => $this->getUnauthorizedCredits(),
                'totalPaysOfDay' => $this->getTotalPaysOfDay(), 'latest' => $this->getTotalLates()
            ]
        );
    }

    public function getActiveClients()
    {
        return count(Client::where('branch_id', Auth::user()->branch_id)->get());
    }

    public function getInactiveClients()
    {
        return count(Client::where('branch_id', Auth::user()->branch_id)->where('status', false)->get());
    }

    public function getAuthorizedCredits()
    {
        return
            count(Credit::whereHas('client', function ($q) {
                return $q->where('branch_id', Auth::user()->branch_id);
            })->where('status', true)->get());
    }

    public function getUnauthorizedCredits()
    {
        return
            count(Credit::whereHas('client', function ($q) {
                return $q->where('branch_id', Auth::user()->branch_id);
            })->where('status', false)->get());
    }

    public function getTotalPaysOfDay()
    {
        $total = Payment::select(DB::raw('sum(efectivo) as total'))->where('status', false)
            ->whereDate('created_at', Carbon::now())
            ->whereHas('credit.client', function ($q) {
                return $q->where('branch_id', Auth::user()->branch_id);
            })->first()->total;

        return $this->formatNumber($total);
    }

    public function getTotalLates()
    {
        $total = 0;
        $payments = Payment::select('id', 'credit_id', 'status', 'fecha', 'fecha_limite', DB::raw('DATEDIFF(fecha_limite,CURDATE()) AS Days'))
            ->orderBy('id', 'DESC')->get();
        foreach ($payments as $value) {
            if ($value->Days < "0") {
                $total = $total + $value->monto;
            }
        }
        return $this->formatNumber($total);
    }

    private function formatNumber($total)
    {
        if ($total != null || $total != 0) {
            return number_format($total, 4);
        } else {
            return number_format(0, 2);
        }
    }


    public function delete($id)
    {
        $notification = Notification::find($id);

        $notification->delete();

        return redirect('/');
    }
}
