<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Communicate\Ask;
use App\Models\Communicate\Carousel;
use App\Models\Communicate\Order;
use App\Models\Communicate\Question;
use App\Models\Service\Physician;
use App\Models\Service\Store;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Class DashboardController.
 */
class CommunicationController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function orderIndex()
    {
        $phy = Physician::select('id','phy_name')->get();
        $store = Store::select('id','store_name')->get();
        return view('backend.communicate.order.index',['phy'=>$phy,'store'=>$store]);
    }



    public function orderData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $phone = $this->request->get('phone');
        $name = $this->request->get('name');
        $time = $this->request->get('time');
        $phy = $this->request->get('phy');
        $store = $this->request->get('store');
        $query = Order::join('store','store.store_position','=','order.order_store')
            ->join('physician','physician.id','=','order.order_phy')->select('order.*','store.store_name','physician.phy_name');
        if($this->request->get('phone')){
            $query->where('order_tel', 'like', "%$phone%");
        }
        if($this->request->get('name')){
            $query->where('order_name', 'like', "%$name%");
        }
        if($this->request->get('time')){
            $query->where('order_time', '>', $time);
        }
        if($this->request->get('phy')){

            $query->where('order_phy', '=', $phy);
        }
        if($this->request->get('store')){
            $query->where('store.id',$store);
        }
        if(access()->user()->contro!=0){
            $query->where('store.id',access()->user()->contro);
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->orderBy('id',$this->request->get('order'))->get();
        return ['total' => $total, 'rows' => $list];
    }

    public function questionIndex(){
        return view('backend.communicate.question.index');
    }

    public function questionData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $name = $this->request->get('name');
        $query = Question::select();
        if($this->request->get('name')){
            $query->where('order_name', 'like', "%$name%");
        }
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }

    public function questionAdd(){
        return view('backend.communicate.question.create');
    }

    public function questionCreate(){
        try{
            $req = $this->request->all();
            $question = new Question();
            $question->question = $req['question'];
            if($question->save()){
                return redirect()->route('admin.question.index')->withFlashSuccess('创建问题成功');
            }else{
                return back()->withErrors('创建问题失败,请稍后再试');
            }
        }catch(Exception $e){
            \log::info($e->getMessage());
            return back()->withErrors('创建问题失败,请稍后再试');
        }
    }

    public function questionUpdate($id){
        $question = Question::find($id);
        return view('backend.communicate.question.edit',['question'=>$question]);
    }

    public function questionEdit(){
        try{
            $req = $this->request->all();
            $question = Question::find($req['id']);
            $question->question = $req['question'];
            if($question->save()){
                return redirect()->route('admin.question.index')->withFlashSuccess('修改问题成功');
            }else{
                return back()->withErrors('修改问题失败,请稍后再试');
            }
        }catch(Exception $e){
            \Log::info($e->getMessage());
            return back()->withErrors('修改问题失败,请稍后再试');

        }
    }

    public function questionDelete(){
        try{
            $id = $this->request->input('id');
            $project = Question::find($id);
            if($project->delete()){
                return return_json('',2000);
            }else{
                return return_err_json('失败',2001);
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function askIndex(){
        return view('backend.communicate.ask.index');
    }

    public function askData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $query = Ask::join('user','ask.user_id','=','user.id')->select('ask.*','user.user_phone');
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->orderBy('created_at','desc')->skip($offset)->take($limit)->get();
        foreach ($list as $k=>$v){}
        return ['total' => $total, 'rows' => $list];
    }

    public function askUpdate($id){
       $ask = Ask::find($id);
       return view('backend.communicate.ask.edit',['ask'=>$ask]);
    }

    public function askEdit(){
        try{
            $req = $this->request->all();
            $ask = Ask::find($req['id']);
            $ask->ask_relay = $req['ask_relay'];
            $ask->ask_status = 1;
            if($ask->save()){
                return redirect()->route('admin.ask.index')->withFlashSuccess('回复成功');
            }else{
                return back()->withErrors('回复失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function askDelete(){
        try{
            $id = $this->request->input('id');
            $ask = Ask::find($id);
            if($ask->ask_status!=2){
                $ask->ask_status = 2;
                $ask->save();
                return return_json();
            }else{
                $ask->ask_status = 0;
                $ask->ask_relay = '';
                $ask->save();
                return return_json();

            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function askHot(){
        try{
            $id = $this->request->input('id');
            $count = Ask::where('ask_hot',1)->count();
            $ask = Ask::find($id);
            if($ask->ask_hot==0){
                if($count==4){
                    return return_err_json('置顶问题为四,请先取消其中一个后,再次设置','2003');
                }
                $ask->ask_hot = 1;
                if($ask->save()){
                    return return_json('','2000','置顶成功');
                }else{
                    return return_err_json('设置失败,请稍后再试');
                }
            }

            $ask->ask_hot = 0;
            if($ask->save()){
                return return_json('','2000','取消置顶成功');
            }else{
                return return_err_json('设置失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function carouselIndex(){
        return view('backend.communicate.carousel.index');
    }

    public function carouselData(){
        $offset = $this->request->get('offset');
        $limit = $this->request->get('limit');
        $query = Carousel::select('id','car_title','car_picture','car_link','car_type');
        $total = $query->count();
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 10;
        $list = $query->skip($offset)->take($limit)->get();
        return ['total' => $total, 'rows' => $list];
    }

    public function carouselAdd(){
        return view('backend.communicate.carousel.create');
    }

    public function carouselCreate(){
        try{
            $req = $this->request->all();
            $car = new Carousel();
            $car->car_title = $req['car_title'];
            $car->car_link = $req['car_link'];
            $car->car_picture = $req['car_picture'];
            $car->car_type = $req['car_type'];
            if($car->save()){
                return redirect()->route('admin.carousel.index')->withFlashSuccess('创建成功');
            }else{
                return back()->withErrors('创建失败 ,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function carouselUpdate($id){
        $car = Carousel::find($id);
        return view('backend.communicate.carousel.edit',['car'=>$car]);
    }

    public function carouselEdit(){
        try{
            $req = $this->request->all();
            $car = Carousel::find($req['id']);
            $car->car_title = $req['title'];
            $car->car_link = $req['link'];
            $car->car_picture = $req['picture'];
            if($car->save()){
                return redirect()->route('admin.carousel.index')->withFlashSuccess('修改成功');
            }else{
                return back()->withErrors('修改失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function carouselDelete(){
        try{
            $id = $this->request->input('id');
            $car = Carousel::find($id);
            if($car->delete()){
                return redirect()->route('admin.carousel.index')->withFlashSuccess('删除成功');
            }else{
                return back()->withErrors('删除失败,请稍后再试');
            }
        }catch (Exception $e){
            \Log::info($e->getMessage());
        }
    }
}
