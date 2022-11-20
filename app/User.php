<?php
namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Order;
class User extends Authenticatable {
	use HasApiTokens, Notifiable;
	use SoftDeletes;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'family', 'mobile', 'email', 'password','nationalCode'
	];
	public function address() {
		return $this->hasMany('App\Address');
	}
	public function DiscountCode() {
		return $this->hasMany('App\DiscountCode');
	}
	public function order() {
		return $this->hasMany('App\Order');
	}
	public function ticket() {
		return $this->hasMany('App\Ticket', 'user_id');
	}
	public function ticket_message() {
		return $this->hasMany('App\TicketMessage');
	}
	public function product_comment() {
		return $this->hasMany('App\ProductComment');
	}
	public function post() {
		return $this->hasMany('App\Post');
	}
	public function api_chat() {
		return $this->hasMany('App\apiChat');
	}
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function roles() {
		return $this->belongsToMany(Role::class , 'role_users');
	}
	public function hasAccess(array $permissions) {
		foreach ($this->roles as $role) {
			if ($role->hasAccess($permissions)) {
				return true;
			}
		}
		return false;
	}
	public function inRole($roleSlug) {
		return $this->roles()->where('slug', $roleSlug)->count() == 1;
	}

	public function VisitorOrder(){
		$orders = Order::where('user_id',$this->id)->get()->count();
		return $orders;
	}

	public function AauthAcessToken(){
		return $this->hasMany('\App\OauthAccessToken');
	}

	public function VNCode($input) {
    if (!preg_match("/^\d{10}$/", $input)
			|| $input=='0000000000'
			|| $input=='1111111111'
			|| $input=='2222222222'
			|| $input=='3333333333'
			|| $input=='4444444444'
			|| $input=='5555555555'
			|| $input=='6666666666'
			|| $input=='7777777777'
			|| $input=='8888888888'
			|| $input=='9999999999') {
			        return false;
			    }
			    $check = (int) $input[9];
			    $sum = array_sum(array_map(function ($x) use ($input) {
			        return ((int) $input[$x]) * (10 - $x);
			    }, range(0, 8))) % 11;
			    return ($sum < 2 && $check == $sum) || ($sum >= 2 && $check + $sum == 11);
		}
}
