<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackDailyVisit
{
    public function handle(Request $request, Closure $next)
    {
        // Kun GET requests til HTML-sider
        if ($request->method() === 'GET' && !$request->ajax()) {
            $ip = $request->ip();

            // Spring over egne IP'er
            $exclude = config('analytics.exclude_ips', []);
            if (!in_array($ip, $exclude, true)) {

                // Bestem "slug key" for tracking
                $slugKey = $this->resolveSlugKey($request);

                if ($slugKey) {
                    DB::table('blog_clicks')->insertOrIgnore([
                        'slug'       => $slugKey,                // fx '__home__' for forsiden
                        'ip'         => $ip,
                        'clicked_at' => now(),
                        'visited_on' => now()->toDateString(),
                    ]);
                }
            }
        }

        return $next($request);
    }

    protected function resolveSlugKey(Request $request): ?string
    {
        // Ignorér statiske filer/asset-paths (tilpas efter dit setup)
        $path = $request->path();
        if (preg_match('#^(build/|storage/|images/|css/|js/|vendor/|favicon)#', $path)) {
            return null;
        }

        // Forside → track som special slug
        if ($request->routeIs('home') || $path === '/') {
            return '__home__';
        }

        // Indlægsside (navngiven route + implicit binding til Insight)
        // Hvis din route hedder 'insights.show' og parameteren er {insight}
        if ($request->routeIs('insights.show')) {
            $insight = $request->route('insight'); // model via implicit binding
            return $insight?->slug ?? null;
        }

        // Andre sider kan du vælge at tracke samlet
        // return '__page__:' . $path; // hvis du også vil måle alle sider
        return null;
    }
}
