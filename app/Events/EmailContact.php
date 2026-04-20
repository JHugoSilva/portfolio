<?php

namespace App\Events;

use App\Models\Contact;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailContact
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contact;
    public $about;
    public $medias;
    /**
     * Create a new event instance.
     */
    public function __construct(Contact $contact, $about = '', $medias = '')
    {
        $this->contact = $contact;
        $this->about = $about;
        $this->medias = $medias;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
