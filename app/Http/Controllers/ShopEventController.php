<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Event;

class ShopEventController extends Controller
{
    public function store(Request $request, Shop $shop)
    {
        $this->authorize('update', $shop);
        $data = $request->validate([
            'event_id' => ['required', 'exists:events,id']
        ]);

        $shop->events()->syncWithoutDetaching($data['event_id']);
        return back()->with('success', 'Event toegevoegd!');
    }

    public function destroy(Shop $shop, Event $event)
    {
        $this->authorize('update', $shop);

        $shop->events()->detach($event->id);
        return back()->with('success', 'Event verwijderd!');
    }

    public function toggleGoing(Event $event)
    {
        $user = auth()->user();
        if ($user->role !== 'seller') {
            abort(403);
        }

        $shop = Shop::where('user_id', $user->id)->firstOrFail();

        if ($shop->events()->where('event_id', $event->id)->exists()) {
            $shop->events()->detach($event->id);
            $msg = 'Event verwijderd van je shop.';
        } else {
            $shop->events()->attach($event->id);
            $msg = 'Event toegevoegd aan je shop.';
        }

        return back()->with('success', $msg);
    }
}
