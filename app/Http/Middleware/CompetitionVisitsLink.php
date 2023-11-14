<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\CompetitionJoin;
use App\Models\CompetitionLinks;
use App\Models\CompetitionVisitCount;
class CompetitionVisitsLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd($request->url());
        if(request('reference')):
            $competitior = CompetitionJoin::where('code',$request->query('reference'))->first();
            if($competitior):
                $competition_link = CompetitionLinks::where([
                    ['link','like','%'.$request->url().'%'],
                    ['competition_id','=',$competitior->competition_id]
                ])->first();

                if($competition_link):
                    $competititor_with_link = CompetitionVisitCount::where([
                        ['competition_join_id','=',$competitior->id],
                        ['competition_link_id','=',$competition_link->id],
                    ])->first();

                    if($competititor_with_link):
                        $competititor_with_link->link_visits()->updateOrCreate([
                            'identifier'                => $request->header('X-Real-IP'),
                            'competition_visit_link_id' => $competititor_with_link->id
                        ]);
                    endif;
                endif;
            endif;
        endif;


        return $next($request);
    }
}