<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Post;
use App\Models\Ward;
use Illuminate\Http\Request;
use LaravelFullCalendar\Calendar;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showWardInDistrict(Request $request)
    {

        if ($request->ajax()) {
            $wards = Ward::Where('maqh', $request->address)->get();
            return response()->json($wards);
        }

    }

    public function getAttribute(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::find($request->category_id);
                $attributes = $category->attributes;
        }
        return response()->json($attributes);
    }

    public function getValueAttribute(Request $request){
        if ($request->ajax()){
            $attributes=Attribute::find($request->attribute_id);
            return Response($attributes);
        }
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')->get();
            if ($posts) {
                foreach ($posts as $post) {
                    $output .= '<tr>
                    <td>' . $post->title . '</td>
                    <td>' . getStatus($post->status) . '</td>
                    <td>' . $post->description . '</td>
                    <td>' . $post->price . '</td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }

    public function getTimeline(Request $request)
    {
        $postEvents = Post::where('employee_id', $request->id)->where('status', '<', 5)->get();
        $html = '';
        $evenList = [];
        foreach ($postEvents as $postEvent) {
            $timeStart = new \DateTime($postEvent->time_start);
            $timeEnd = new \DateTime($postEvent->time_end);
            $evenList[] = Calendar::event(
                '+>' . $timeStart->format('H:i') . '->' . $timeEnd->format('H:i') . ' :  Làm việc tại ' . $postEvent->ward->name . ',' . $postEvent->district->name,
                true,
                $timeStart,
                $timeEnd,
                $postEvent->id,
                [
                    'url' => route('manager.post.details', ['id' => $postEvent->id])
                ]
            );
        }
        $calendar = \Calendar::addEvents($evenList)
            ->setOptions([ //set fullcalendar options
                'firstDay' => 1,
                'height'=>400
            ]);

        $html .= '<div class="modal fade show" id="modal" tabindex="-1" role="dialog" style="display: inline" aria-labelledby="exampleModalLabel" aria-hidden="true">'
            . '<div class="modal-dialog modal-lg" role="document">'
            . ' <div class="modal-content">'
            . '<div class="modal-header">'
            . '<h5 class="modal-title" id="exampleModalLabel">'.Employee::find($request->id)->name.'</h5>'
            . ' <button type="button" class="close" onclick=" closeModal()" data-dismiss="modal" aria-label="Close">'
            . '  <span aria-hidden="true">&times;</span>'
            . ' </button>'
            . ' </div>'
            . ' <div class="modal-body">'
            .   $calendar->calendar() . '<br/>' .
                $calendar->script()
            . ' </div>'
            . '<div class="modal-footer">'
            . ' </div>'
            . ' </div>'
            . '</div>'
            . '</div>';
        return Response($html);
    }
}
