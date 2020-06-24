<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\models\submissions\submissionsModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class guestRequestController extends Controller
{
    //

    public function getAboutUsPage()
    {
        return view('homepage.aboutus');
    }

    public function getHomePage()
    {
        $trendingPublications = $this->GetTrendingPapers();
        // return $trendingPublications;
        return view('homepage.index', compact('trendingPublications'));
    }

    public function viewPublication(Request $request, $sub_id, $sub_token)
    {
        $publication = submissionsModel::where([
            ['id', $sub_id],
            ['submssion_token', $sub_token]
        ])->get();

        abort_if($publication == null || $publication->count() <= 0, 404);
        $publication = $publication[0];
        return view('submissions.guest_view', compact('publication'));
    }

    public function GetTrendingPapers()
    {
        $publishedSubmissions = submissionsModel::wherehas('SubmissionChanges', function (Builder $query) {
            $query->where('target_status', '=', 4);
        })->where('submission_status', 4)->get();
        return $publishedSubmissions;
    }
}
