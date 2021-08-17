<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\VolumesModel;
use App\Models\Submissions\SubmissionChangesTrackerModel;
use App\Models\Submissions\SubmissionsModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class guestRequestController extends Controller
{
    //

    public function getAboutUsPage()
    {
        return view('homepage.aboutus');
    }
    public function ViewContactUsPage()
    {
        return view('homepage.contactus');
    }

    public function getHomePage()
    {
        $trendingPublications = $this->GetTrendingPapers();
        // return $trendingPublications;
        return view('homepage.index', compact('trendingPublications'));
    }

    public function viewPublication(Request $request, $sub_id, $sub_token)
    {
        $publication = SubmissionsModel::where([
            ['id', $sub_id],
            ['submssion_token', $sub_token]
        ])->get();

        abort_if($publication == null || $publication->count() <= 0, 404);
        $publication = $publication[0];
        return view('submissions.guest_view', compact('publication'));
    }

    public function GetTrendingPapers()
    {
        $publishedSubmissions = SubmissionsModel::wherehas('SubmissionChanges', function (Builder $query) {
            $query->where('target_status', '=', 4);
        })->where('submission_status', 4)->get();
        return $publishedSubmissions;
    }

    public function OpenArchivePage()
    {
        $publication = SubmissionsModel::get();

        $publishedSubmissions = SubmissionChangesTrackerModel::where('target_status', 4)->get();
        // $publications = $this->GetTrendingPapers();
        $all_volumes = VolumesModel::latest()->get();
        $volumes = [];
        foreach ($all_volumes as $key => $volume) {
            if(in_array($volume->year, $volumes)){
                if(in_array($volume->month, $volume[$volume->volume_year]["issues"])){
                    array_push( $volumes[$$volume->volume_year]["issues"], [
                        ["title" => $volume->Submissions->submission_title,
                        "id" => $volume->volume_submission_id,
                        "token" =>$volume->volume_submission_token]
                    ]);
                }
                else{
                    $issue = [
                        "issue_name" => $volume->volume_month,
                        "articles" => [
                            ["title" => $volume->Submissions->submission_title,
                            "id" => $volume->volume_submission_id,
                            "token" =>$volume->volume_submission_token]
                        ] 
                    ];
                    $volumes[$volume->volume_year]["issues"] = [$issue];
                }
            }
            else{
                $volumes[$volume->volume_year]["volume_name"] = $volume->volume_year;
                $issue = [
                    "issue_name" => $volume->volume_month,
                    "articles" => [
                        ["title" => $volume->Submissions->submission_title,
                        "id" => $volume->volume_submission_id,
                        "token" =>$volume->volume_submission_token]
                        ] 
                ];
                $volumes[$volume->volume_year]["issues"] =  [$issue];
            }
        }
        return view('homepage.archive', compact('publishedSubmissions', 'volumes'));
    }
}
