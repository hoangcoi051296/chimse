<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class FeedbackController extends Controller
{
    protected $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function index()
    {
        $feedbacks = $this->feedback->paginate(10);
        return view('customer.feedback.index', compact('feedbacks'));
    }
    public function edit($id){
        $feedback = Feedback::find($id);
        return view('customer.feedback.edit',compact('feedback'));
    }
    public function update(Request $request, $id){
        $feedback = $this->feedback->find($id);
        $feedback->update([
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);
        $employee =Employee::find($feedback->employee_id);
        $a =DB::table('feedback')->where('employee_id',$employee->id)->get();
        $avgRate =  $a->avg('rating');
        $employee->avgRate=$avgRate;
        $employee->save();
        return redirect()->route('customer.feedback.index');
    }
}
