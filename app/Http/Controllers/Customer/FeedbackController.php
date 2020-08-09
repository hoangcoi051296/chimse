<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Post;
use App\Models\Address;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    protected $feedback;
    protected $post;

    public function __construct(Post $post, Feedback $feedback)
    {
        $this->feedback = $feedback;
        $this->post = $post;
        $address = Address::where('id', 01)->get();
        view()->share(compact('address'));
    }

    public function index()
    {
        $feedbacks = $this->feedback->paginate(10);
        return view('customer.feedback.index', compact('feedbacks'));
    }


}
