<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Insight;

class LikeButton extends Component
{
    public $insight;
    public $liked;
    public $likeCount;

    public function __construct(Insight $insight)
    {
        $this->insight = $insight;

        $user = Auth::user();
        $this->liked = $user ? $insight->isLikedBy($user) : false;
        $this->likeCount = $insight->likes()->count();
    }

    public function render()
    {
        return view('components.like-button');
    }
}
