<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductComment;
use App\Ticket;
use App\Order;
use App\Product;
use App\ProductImage;
use App\ProductPrice;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller {
	/**
	 * [index show user admin panel"
	 * @return [view] [return view page in Front.panel.panel]
	 */
	public function index(Request $request) {
		$comments = ProductComment::where("read", 0)->get();
		$tickets  = Ticket::where("read", 0)->get();
		$orders  = Order::where("status", 0)->get();
		$online_orders = Order::where('status',0)->where('pay_method',1)->take(5)->get();
		$order = [
			'0' =>  Order::where('created_at', '>=', \Carbon\Carbon::today())->get()->count() ,
			'1'=>   Order::where('created_at', '>=', \Carbon\Carbon::today()->subDays(2))->get()->count(),
			'2'=>	  Order::where('created_at', '>=', \Carbon\Carbon::today()->subDays(7))->get()->count(),
			'3'=>	  Order::where('created_at', '>=', \Carbon\Carbon::today()->subDays(15))->get()->count(),
			'4'=>	  Order::where('created_at', '>=', \Carbon\Carbon::today()->subDays(23))->get()->count(),
			'5'=>	  Order::where('created_at', '>=', \Carbon\Carbon::today()->subDays(30))->get()->count(),
			'6'=>	  Order::where('created_at', '>=', \Carbon\Carbon::today()->subDays(60))->get()->count(),
			'7'=>	  Order::where('created_at', '>=', \Carbon\Carbon::today()->subDays(90))->get()->count(),
		];
		$users = [
			'0' =>  User::where('created_at', '>=', \Carbon\Carbon::today())->get()->count(),
			'1'=>   User::where('created_at', '>=', \Carbon\Carbon::today()->subDays(2))->get()->count(),
			'2'=>	  User::where('created_at', '>=', \Carbon\Carbon::today()->subDays(7))->get()->count(),
			'3'=>	  User::where('created_at', '>=', \Carbon\Carbon::today()->subDays(15))->get()->count(),
			'4'=>	  User::where('created_at', '>=', \Carbon\Carbon::today()->subDays(23))->get()->count(),
			'5'=>	  User::where('created_at', '>=', \Carbon\Carbon::today()->subDays(30))->get()->count(),
			'6'=>	  User::where('created_at', '>=', \Carbon\Carbon::today()->subDays(60))->get()->count(),
			'7'=>	  User::where('created_at', '>=', \Carbon\Carbon::today()->subDays(90))->get()->count(),
		];
		$chartjs = app()->chartjs
				->name('lineChartTest')
				->type('line')
				->size(['width' => 800, 'height' => 200])
				->labels(['یک روز گذشته',' دو روز','یک هفته','دو هفته','سه هفته','یک ماه','دو ماه','سه ماه'])
				->datasets([
						[
								"label" => "تعداد بازدید ها ",
								'borderColor' => "rgba(38, 185, 154, 0.7)",
								"pointHoverBackgroundColor" => "#fff",
								'fill'=> false,
								"pointHoverBorderColor" => "rgba(220,220,220,1)",
								'data' => [\Counter::allHits(1),\Counter::allHits(2),\Counter::allHits(7),\Counter::allHits(15),\Counter::allHits(23),\Counter::allHits(30),\Counter::allHits(60),\Counter::allHits(90)],
						],
						[
								"label" => "تعداد خرید ها",
								'borderColor' => "#9e003d",
								"pointHoverBackgroundColor" => "#fff",
								'fill'=> false,
								"pointHoverBorderColor" => "rgba(220,220,220,1)",
								'data' => [$order[0],$order[1],$order[2],$order[3],$order[4],$order[5],$order[6],$order[7]],
						 ],
						[
								"label" => "تعداد کاربران",
								'borderColor' => "#ecf209",
								"pointHoverBackgroundColor" => "#fff",
								'fill'=> false,
								"pointHoverBorderColor" => "rgba(220,220,220,1)",
								'data' => [$users[0],$users[1],$users[2],$users[3],$users[4],$users[5],$users[6],$users[7]],
						]
				])
				->options([]);
		return $request->ajax()?view('Admin.ajax.index', compact('comments', 'tickets','orders','online_orders','chartjs')):view('Admin.index.index', compact('comments', 'tickets','orders','online_orders','chartjs'));
	}

	public function import(){
	 $row = 0;
     $link = "https://www.tecmint.com/linux-commands-cheat-sheet/";
		while(true)
		{
		$image = file_get_contents("http://g02.ir/api/v1/public/?link=".$link);
		$rand = rand(5,12);
		$code = substr(str_shuffle(str_repeat("0123456789QWERTYUIOPASDFGHJKLZXCVBNMabcdefghijklmnopqrstuvwxyz", $rand)), 0, $rand);
		$code2 = substr(str_shuffle(str_repeat("0123456789QWERTYUIOPASDFGHJKLZXCVBNMabcdefghijklmnopqrstuvwxyz", $rand)), 0, $rand);
		$link = "https://www.".$code.".com/".$code.$rand.$code2."/".$code2;
		$image = $row."--".$image;
		$fp = fopen("file.txt", 'a');
        fwrite($fp, $image.PHP_EOL);
		fclose($fp);
		$row++;
		}
	}
}
