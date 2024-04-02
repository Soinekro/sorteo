<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function mis_tickets()
    {
        if (auth()->user()->id > 1) {
            $tickets = Ticket::where('user_id', auth()->id())
                ->orderBy('id', 'asc')
                ->paginate(6);
            $ofertas = [];
            $files = scandir(public_path('img/ofertas'));
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $ofertas[] = 'img/ofertas/' . $file;
                }
            }
            $ofertas_rand = [];
            for ($i = 0; $i <= 3; $i++) {
                $ofertas_rand[] = $ofertas[array_rand($ofertas)];
            }
        } else {
            $tickets = Ticket::orderBy('id', 'asc')
                ->paginate(12);
            $ofertas_rand = [];
        }
        return view('mis_tickets', compact('tickets', 'ofertas_rand'));
    }
}
