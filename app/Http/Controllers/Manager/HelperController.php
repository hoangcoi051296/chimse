<?php


namespace App\Http\Controllers\Manager;

use App\Mail\AccountCreated;
use App\Mail\AccountHelperCreated;
use App\Models\Address;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\TinhTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HelperController extends Controller
{
    protected $manager;
    protected $helper;

    public function __construct(
        Manager $manager,
        Employee $helper
    ) {
        $this->manager = $manager;
        $this->helper = $helper;
        $address = Address::where('matp', 01)->get();
        view()->share(compact('address'));
    }

    public function index(Request $request)
    {
        $condition = $request->all();
//        $condition['status']=[
//            1,2,3
//        ];
        $helpers = $this->helper->getData($condition, $request)->paginate($this->helper->perPage);
        return view('manager.employee.index', compact('helpers'));
    }

    public function create()
    {
        return view('manager.employee.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->helper->rules());
        try {
            $this->helper->createData($request);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        $employee =$request->all();
        Mail::to($request->email)->send( new AccountHelperCreated($employee));
        return redirect()->route('manager.employee.index')->with("success", "Create Success");
    }

    public function edit($id)
    {
        $helper = Employee::find($id);
        return view('manager.employee.edit', compact('helper'));
    }

    public function updateData(Request $request, $id)
    {
        $request->validate($this->helper->rules($id));
        try {
            $this->helper->updateData($request, $id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.employee.index')->with("success", "Create Success");
    }

    public function delete($id)
    {
        try {
            $this->helper->deleteData($id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.employee.index')->with("success", "Delete Success");
    }
}
