<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Insight;

class InsightCard extends Component
{
    public $insight;

    public function __construct(Insight $insight)
    {
        $this->insight = $insight;
    }

    public function render()
    {
        return view('components.insight-card');
    }
}
