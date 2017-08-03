<?php
/**
 * 订单模块
 * @author ZENG
 * Date: 2017/7/26
 * Time: 11:24
 */
namespace App\Http\Controllers\Admin;

use App\Model\Admin\Address;
use App\Model\Admin\Admin;
use App\Model\Admin\Good;
use App\Model\Admin\Order;
use App\Model\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Style\Font;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders=DB::table('orders')
            ->join('user', 'orders.uid', '=', 'user.id')
            ->select(['orders.id','user.phone','user.email','orders.order_on','orders.status','orders.gid','orders.price','orders.payment','orders.created_at'])
            ->orderBy('orders.created_at', 'desc')
            ->paginate(15);
        $orderlist=$orders->toArray();
        foreach($orderlist['data'] as $d){
            $gid=json_decode($d->gid,true);
            $goodname=[];
            foreach($gid as $k =>$v){
                $good=Good::find($k,['name']);
                array_push($goodname,$good->toArray()['name']);
                $good=$good->toArray();

            }
            $d->goodname=$goodname;
        }

        $user=Admin::where(['name'=>Session::get('user')])->first();
        return view('admin/orderlist',['title'=>'添加产品','navi'=>'order','user'=>$user,'page'=>$orders,'order'=>$orderlist]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        $goodid=$request->input('good');
//        $amount=$request->input('amount');
//        $data=json_encode(array_combine($goodid,$amount));
        $order=Order::find($request->input('id'));
//        $order->gid=$data;
        $order->price=$request->input('price');
        $order->payment=$request->input('payment');
        $order->preferential=$request->input('preferential');
        $order->status=$request->input('status');
        if($order->save()){
            return '1';
        }else{
            return '修改失败';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data=DB::table('orders')
            ->join('user', 'orders.uid', '=', 'user.id')
            ->where(['orders.id'=>$id])
            ->get(['orders.id','user.phone','user.email','orders.order_on','orders.status','orders.gid','orders.price','orders.payment','orders.created_at','orders.preferential','orders.aid']);
        $order=$data->toArray()['0'];
        $gid=json_decode($order->gid,true);
        $name=[];
        foreach($gid as $k=>$v){
            $user=Good::find($k,['name']);
            $user=$user->toArray();
            array_push($name,$user['name']);
        }
        $order->gid=array_combine($name,array_values($gid));
        //收货地址，联系人，联系人电话
        $address=Address::find($order->aid,['id','address','phone','people']);
        $address=$address->toArray();
        $order->aid=$address;
        $user=Admin::where(['name'=>Session::get('user')])->first();
        return view('admin/update_order',['title'=>'添加产品','navi'=>'order','user'=>$user,'order'=>$order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $order=Order::find($id);
        $order->status='6';
        if($order->save()){
           return '1';
        }else{
            return '修改失败';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * 选择性删除
     * @param Request $request
     * @return string
     */
    public function deleteAll(Request $request){
        $batch_delete_val=$request->input('check');
        if(Order::destroy($batch_delete_val)){
            return '1';
        }else{
            return '删除失败';
        }
    }

    /**
     * 根据id删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id){
        if(Order::destroy($id)){
            return redirect(url('orderlist'));
        }
    }

    /**
     * 按条件查询
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function select(Request $request){
        $date=$request->input('date');
        $order_no=$request->input('order_no');
        $goodname=[];
        //时间为空，只查订单号或者手机号
        if(empty($date)&&!empty($order_no)){
            if (preg_match('/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/',$order_no)){
                $where=['user.email'=>$order_no];
            }elseif(preg_match('/^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/',$order_no)){
                $where=['user.phone'=>$order_no];
            }else{
                $where=['orders.order_on'=>$order_no];
            }

            $orders=DB::table('orders')
                ->join('user', 'orders.uid', '=', 'user.id')
                ->where($where)
                ->orderBy('orders.created_at', 'desc')
                ->select(['orders.id','user.phone','user.email','orders.order_on','orders.status','orders.gid','orders.price','orders.payment','orders.created_at'])
                ->paginate(15);
          //时间不为空，手机号或者订单号为空
        }elseif (!empty($date)&&empty($order_no)){
            $orders=DB::table('orders')
                ->join('user', 'orders.uid', '=', 'user.id')
                ->whereBetween('orders.created_at',[$date.' 00:00:00',$date.' 11:59:59'])
                ->orderBy('orders.created_at', 'desc')
                ->select(['orders.id','user.phone','user.email','orders.order_on','orders.status','orders.gid','orders.price','orders.payment','orders.created_at'])
                ->paginate(15);

        //时间跟手机号或者订单号都不为空
        }else{
            if (preg_match('/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/',$order_no)){
                $where=['user.email'=>$order_no];
            }elseif(preg_match('/^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/',$order_no)){
                $where=['user.phone'=>$order_no];
            }else{
                $where=['orders.order_on'=>$order_no];
            }
            $orders=DB::table('orders')
                ->join('user', 'orders.uid', '=', 'user.id')
                ->where($where)
                ->orderBy('orders.created_at', 'desc')
                ->whereBetween('orders.created_at',[$date.' 00:00:00',$date.' 11:59:59'])
                ->select(['orders.id','user.phone','user.email','orders.order_on','orders.status','orders.gid','orders.price','orders.payment','orders.created_at'])
                ->paginate(15);

        }
        $order=$orders->toArray();
        foreach($order['data'] as $d){
            $gid=json_decode($d->gid,true);
            $goodname=[];
            foreach($gid as $k =>$v){
                $good=Good::find($k,['name']);
                array_push($goodname,$good->toArray()['name']);
                $good=$good->toArray();

            }
            $d->goodname=$goodname;
        }
        //设置分页url
        $orders->setPath('/order/query?date='.$date.'&order_no='.$order_no);

        $user=Admin::where(['name'=>Session::get('user')])->first();
        return view('admin/orderlist',['title'=>'添加产品','navi'=>'order','user'=>$user,'page'=>$orders,'order'=>$order]);
    }

    /**
     * 导出订单
     * @param $date     导出订单的日期
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function export($date){
        if(empty($date)) return false;

        $orders=Order::whereBetween('created_at',[$date.' 00:00:00',$date.' 11:59:59'])
                        ->where(['status'=>'3'])
                        ->get();
        //假如没有数据，直接重定向到订单列表页
        if($orders->isEmpty()) return redirect(url('orderlist'));

        $orderlist=$orders->toArray();
        $data=[];
        foreach($orderlist as $v){
            $adderss=Address::find($v['aid'],['address','people','phone']);
            $v['aid']=$adderss->toArray();
            $gid=json_decode($v['gid']);
            $goodname=[];
            foreach($gid as $k=>$i){
                $name=Good::find($k,['id','name','price_t']);
                $good=$name->toArray();
                array_push($goodname,['name'=>$good['name'],'amount'=>$i,'price'=>$good['price_t']]);
            }
            $v['gid']=$goodname;
           array_push($data,$v);

        }


        $file=$this->dataToDoc($data);

        return response()->download($file);
    }

    /**
     * 遍历数据并生成doc文件并保存
     * @param $data
     * @return string
     */
    private function dataToDoc($data){
        $phpWord=new PhpWord();
        Settings::setCompatibility(false);
        Settings::setZipClass(Settings::PCLZIP);
        $section = $phpWord->addSection();
        foreach($data as $v) {
            $phpWord->addTitleStyle(1, ['bold' => true, 'color' => '#0d3625', 'size' => 17, 'name' => 'Verdana']);
            $section->addTitle('蔬菜配送中心配送单', 1);
            $section->addText(
                '订单创建日期 ：'.$v['created_at'], array('name' => 'Verdana', 'size' => 12)
            );
            $section->addText(
                '订单号 ：'.$v['order_on'].'                                                     送货员：   ', array('name' => 'Verdana', 'size' => 12)
            );
            $section->addText(
                '送货地址 ：'.$v['aid']['address'], array('name' => 'Verdana', 'size' => 12)
            );
            $section->addText(
                '联系人 ：'.$v['aid']['people'].'                                                        联系电话：'.$v['aid']['phone'], array('name' => '仿宋', 'size' => 12)
            );

            //
            $styleTable = [
                'borderColor' => '006699',
                'borderSize' => 6,
                'cellMargin' => 50,
            ];
            $styleFirstRow = ['bgColor' => '66BBFF'];//第一行样式
            $phpWord->addTableStyle('myTable', $styleTable, $styleFirstRow);
            $table = $section->addTable('myTable');
            $table->addRow(600);//行高400
            $table->addCell(1000)->addText('序号');
            $table->addCell(3000)->addText('菜品名称');
            $table->addCell(3000)->addText('单价');
            $table->addCell(3000)->addText('数量');
            for($i=0;$i<count($v['gid']);$i++) {
                $table->addRow(600);//行高400
                $table->addCell(1000)->addText($i+1);
                $table->addCell(1000)->addText($v['gid'][$i]['name']);
                $table->addCell(3000)->addText($v['gid'][$i]['price']);
                $table->addCell(3000)->addText($v['gid'][$i]['amount']);
            }

            $table->addRow(600);
            $table->addCell(1600,array('cellMerge' => 'restart', 'valign' => "center"));
            $table->addCell(1600, array('cellMerge' => 'continue'));
            $table->addCell(1600, array('cellMerge' => 'continue'))->addText('总价                        ￥'.$v['price']);
            $table->addCell(1600, array('cellMerge' => 'continue'))->addText('实际支付                  ￥'.$v['price']);

            $section->addPageBreak();                                     //分页

        }
        if(!is_dir('/var/www/html/assistant-chef/public/Doc/'.date('Y-m-d',time()))){
            mkdir('/var/www/html/assistant-chef/public/Doc/'.date('Y-m-d',time()));
        }
        $objWriter=IOFactory::createWriter($phpWord, 'Word2007');
        $name='/var/www/html/assistant-chef/public/Doc/'.date('Y-m-d',time()).'/'.time().'.doc';
        $objWriter->save($name);

        return $name;
    }

}
