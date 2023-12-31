<?php

namespace App\Events\Models\Post;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $post;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return new PresenceChannel('presence.post.' . $this->post->id);
    }

    public function broadcastAs(){
        return 'post.updated';
    }

    public function broadcastWith()
    {
        return [
            'post' => $this->post,
        ];
    }
}
