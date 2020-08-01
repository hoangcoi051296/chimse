<?php


namespace App\Http\Controllers\Manager;


use App\Models\Helper;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    protected $manager;
    protected $helper;
    public function __construct(
        Manager $manager,Helper $helper
    )
    {
        $this->manager = $manager;
        $this->helper = $helper;
    }

    public function index(Request $request){

        $condition = $request->all();
        $condition['status']=[
            1,2,3
        ];
        $listManager = $this->manager->getData($condition);

        return view('manager.helper.index',compact('listManager'));
    }
    public function create(){
        return view('manager.helper.create');
    }
    public function store(Request $request)
    {
        $request->validate([
                'name' => "required| string| max:255",
                'email' => "required|string|email|max:255|unique:helper",
                'password' => 'required| min:5|confirmed',
                'password_confirmation' => 'required'
            ]
        );
        try {
            $data =$this->helper->data($request);
            $this->helper->fill($data)->save();
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.helper.index')->with("success", "Create Success");
    }

}
