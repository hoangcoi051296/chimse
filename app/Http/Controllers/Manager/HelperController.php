<?php


namespace App\Http\Controllers\Manager;

use App\Mail\AccountCreated;
use App\Mail\AccountHelperCreated;
use App\Models\District;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use LaravelFullCalendar\Calendar;

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
        $address = District::where('matp', 01)->get();
        view()->share(compact('address'));
    }

    public function index(Request $request)
    {
        $condition = $request->all();
        $helpers = $this->helper->getData($condition)->paginate($this->helper->perPage);
        return view('manager.employee.index', compact('helpers'));
    }
    public function details($id){
        $employee=Employee::find($id);
        $postEvents=Post::where('employee_id',$employee->id)->where('status','<',5)->get();
        $evenList=[];
        foreach ($postEvents as $postEvent){
            $timeStart=new \DateTime($postEvent->created_at);
            $timeEnd= new \DateTime($postEvent->updated_at);
            $evenList[]=Calendar::event(
                '+>'.$timeStart->format('H:i').'->'.$timeEnd->format('H:i').' :  Làm việc tại '.$postEvent->ward->name.','.$postEvent->district->name,
                true,
                new \DateTime($postEvent->created_at),
                new \DateTime($postEvent->updated_at),
                $postEvent->id,
                [
                    'url' => route('manager.post.details',['id'=>$postEvent->id])
                ]
            );
        }
        $calendar = \Calendar::addEvents($evenList)
            ->setOptions([ //set fullcalendar options
                'firstDay' => 1
            ]);
        $post =Post::where('employee_id',$employee->id)->where('status',7)->get();
        return view('manager.employee.details',compact('post','employee','calendar'));
    }
    public function create()
    {
        return view('manager.employee.create');
    }

    public function store(Request $request)
    {
        $data=$request->all();
        $request->validate($this->helper->rules(),$this->helper->messages());
        try {
            $this->helper->createData($data);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
//        $employee =$request->all();
//        Mail::to($request->email)->send( new AccountHelperCreated($employee));
        return redirect()->route('manager.employee.index')->with("success", "Tạo thành công");
    }

    public function edit($id)
    {
        $helper = Employee::find($id);
        return view('manager.employee.edit', compact('helper'));
    }

    public function update(Request $request)
    {
        $data=$request->all();
        $request->validate($this->helper->rules($request->id),$this->helper->messages());
        try {
            $this->helper->updateData($data, $request->id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.employee.index')->with("success", "Cập nhật thành công");
    }

    public function delete($id)
    {
        try {
            $this->helper->deleteData($id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.employee.index')->with("success", "Xoá thành công");
    }
}
