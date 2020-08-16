<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
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
        return redirect()->route('customer.feedback.index');
    }
}
