<?php


namespace App\Http\Controllers\Manager;


use App\Models\Address;
use App\Models\Helper;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\TinhTP;
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
        $address=Address::where('matp',01)->get();
        view()->share(compact('address'));
    }

    public function index(Request $request){
        $condition = $request->all();
//        $condition['status']=[
//            1,2,3
//        ];
        $helpers = $this->helper->getData($condition,$request)->paginate($this->helper->perPage);
        return view('manager.helper.index',compact('helpers'));
    }
    public function create(){
        return view('manager.helper.create');
    }
    public function store(Request $request)
    {
        $request->validate($this->helper->rules());
        $this->helper->create($request);
        try {

        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.helper.index')->with("success", "Create Success");
    }
    public function edit($id){
        $helper= Helper::find($id);
        return view('manager.helper.edit',compact('helper'));
    }
    public function update(Request $request,$id)
    {
        $request->validate($this->helper->rules($id));
        try {
            $this->helper->updatee($request,$id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.helper.index')->with("success", "Create Success");
    }
    public function delete($id){
        try {
            $this->helper->deletee($id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.helper.index')->with("success", "Delete Success");
    }
}
