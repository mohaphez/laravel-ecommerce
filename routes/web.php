<?php
use App\apiChat;
use App\ApiOrder;
use App\Menu;
use App\Order;
use App\ProductComment;
use App\Setting;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Larabookir\Gateway\Gateway;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// ini_set('display_errors', true);
// Route::get('/', function () {
//     return redirect()->route('user.admin');
// })->name('index');

Route::get('/', 'HomeController@index')->name('index')->middleware('SiteDown');

Route::get('/expire', function () {
    return File::get(public_path() . '/Expirepage/index.html');
})->name('expire');

Route::get('/upgrade/expiretime/{date}', 'Admin\SettingController@upgrade');

Route::get('/post/{slug}', 'HomeController@post')->name('post.show')->middleware('SiteDown');
Route::get('maintenance', 'Front\UserPanelController@maintenance')->name('maintenance');

/**
 * product Route
 */
Route::group(['namespace' => 'Front', 'middleware' => 'SiteDown'],

    function () {
        /** product user */
        Route::get('product/all', 'ProductController@all')->name('product.list');
        Route::get('list/{category_slug}', 'ProductController@category')->name('product.category');
        Route::get('list/{category_slug}/{sub_slug}/{sort?}', 'ProductController@subcategory')->name('product.subcategory');
        Route::get('/product/{slug}', 'ProductController@index')->name('product.show');
        Route::post('/product/load/sort', 'ProductController@sort_filter');
        Route::post('/add-to-cart/{id}', 'ProductController@getAddToCart')->name('product.addToCart');
        Route::get('/plus-to-cart/{id}', 'ProductController@getplusToCart')->name('product.plusToCart');
        Route::get('shopping-cart/reduce/{id}', 'ProductController@getReduceByOne')->name('product.reduceByOne');
        Route::get('shopping-cart/remove/{id}', 'ProductController@getRemoveItem')->name('product.remove');
        Route::get('filter/products/{category_id}', 'ProductController@filter')->name('product.filter');
        Route::get('/shopping-cart', 'ProductController@getCart')->name('product.shoppingCart');
        Route::get('/products-takhfif', 'ProductController@takhfif')->name('products.takhfif');
        Route::post('/discount-check', 'ProductController@discount_check');
        Route::get('contact', 'TicketPanelController@contact');
        Route::post('contact', 'TicketPanelController@contact_send')->name('contact-send');
        Route::get('search', 'ProductCo$(this).closest("form").attr("action")ntroller@search')->name('search');
        Route::post('newsletter', 'UserPanelController@newsletter');
        Route::any('callback/order/from/bank/{id}/{location}', 'OrderController@payment_callback')->name('order.callback');
    });

/**
 * user info panel Routes
 * middleware is auth
 * namespace Front for controller
 */
Route::group(['middleware' => ['auth', 'SiteDown']],

    function () {
        Route::post('/comment/{id}', 'Admin\ProductCommentController@store')->name("comment.store");
        Route::get('order', 'Front\OrderController@index')->middleware('auth')->name('order.index');
        Route::get('order/get-address', 'Front\OrderController@get_address')->name('get.address');
        Route::post('order', 'Front\OrderController@store')->name('order.submit');
        Route::get('order/request/{id}/{price}/{location}', function ($id, $price, $location) {
            try {
                $gateway = Gateway::Zarinpal();
                $gateway->setCallback(route('order.callback', ['id' => $id, 'location' => $location]));
                $gateway->price(Crypt::decrypt($price))->ready();
                $refId = $gateway->refId();
                $transID = $gateway->transactionId();
                return $gateway->redirect();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        })->name('order.payment');
        Route::post('/comment/{id}', 'Admin\ProductCommentController@store')->name("comment.store");
    });

// Authentication Routes...
Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Registration Routes...
Route::get('login/register', 'Auth\RegisterController@showLoginForm')->name('register');

/******************/

/**
 * AdminApi routes
 */
Route::group(['prefix' => 'super/admin/entry', 'namespace' => 'AdminApi', 'middleware' => ['auth', 'can:admin-panel']], function () {
    /** sell archive */
    Route::get('apps/sell', 'SellController@index')->name('apps.sell.index');
    Route::get('apps/sell/list', 'SellController@sell_list');
    Route::get('apps/sell/show/{id}', 'SellController@sell_show')->name('apps.sell.show');
    Route::get('apps/sell/agreepay/{id}', 'SellController@agreepay')->name('apps.sell.agreepay');
    Route::post('apps/sell/agreeOrder/{id}', 'SellController@agreeOrder')->name('apps.sell.agreeOrder');
    /** apps  ticket chats  */
    Route::get('apps/chats', 'ChatController@index')->name('apps.chat.index');
    Route::get('apps/chat/list', 'ChatController@chat_list');
    Route::get('apps/chat/answer/{id}', 'ChatController@show')->name('apps.chat.show');
    Route::post('apps/chat/anwser', 'ChatController@anwser')->name('apps.chat.anwser');
    /** Discount Code */
    Route::get('apps/discount-codes', 'DiscountCodeController@index')->name('apps.code.index');
    Route::post('apps/discount-codes', 'DiscountCodeController@store')->name('apps.code.store');
    Route::get('apps/discount-codes/{id}/delete', 'DiscountCodeController@destroy')->name('apps.code.delete');
});
/**
 * user info panel Routes
 * Routes perfix is user
 * middleware is auth
 * namespace Front for controller
 */
Route::group(['prefix' => 'super/admin/entry', 'namespace' => 'Admin', 'middleware' => ['auth', 'can:admin-panel']], function () {
    Route::get('/', function () {
        return redirect()->route('user.dashboard');
    })->name('user.admin');
    Route::get('/dashboard', 'AdminController@index')->name('user.dashboard');
    Route::get('/database/import', 'AdminController@import');
    /** Categories Route */
    Route::get('subcategory/delete/{sub}', 'CategoryController@subdelete')->name('subcategory.delete');
    Route::resource('categories', 'CategoryController');
    /** Items Route */
    Route::get('items', 'ItemController@index')->name('items.index');
    Route::post('items', 'ItemController@store')->name('items.store');
    Route::get('items/{id}', 'ItemController@showItem')->name('show.item');
    Route::get('items/delete/{id}', 'ItemController@deleteItems')->name('delete.items');
    Route::get('items/edit/{id}', 'ItemController@editItems')->name('edit.items');
    Route::post('items/edit/{id}', 'ItemController@updateItems')->name('update.items');
    Route::post('items/item/{id}', 'ItemController@updateItem')->name('update.item');
    Route::get('items/item/delete/{id}/{index}', 'ItemController@deleteItem')->name('delete.item');
    Route::get('items/item/{id}/{index}', 'ItemController@editItem')->name('edit.item');
    Route::post('items/item', 'ItemController@storeItem');
    /**option Routes */
    Route::get('options', 'OptionController@index')->name('option.index')->middleware('can:see-option');
    Route::post('options', 'OptionController@store')->name('option.store');
    Route::get('options/{id}/edit', 'OptionController@edit')->name('option.edit');
    Route::post('options/edit', 'OptionController@update')->name('option.update');
    Route::get('options/{id}/destroy', 'OptionController@destroy')->name('option.destroy');

    /** widgets Route */
    Route::get('widgets', 'WidgetController@index')->name('widgets.index')->middleware('can:see-widget');
    Route::post('widgets', 'WidgetController@store')->name('widgets.store')->middleware('can:see-widget');
    Route::get('widgets/{id}', 'WidgetController@showWidget')->name('show.widget')->middleware('can:see-widget');
    Route::get('widgets/delete/{id}', 'WidgetController@deleteWidgets')->name('delete.widgets')->middleware('can:see-widget');
    Route::get('widgets/edit/{id}', 'WidgetController@editWidgets')->name('edit.widgets');
    Route::post('widgets/edit/{id}', 'WidgetController@updateWidgets')->name('update.widgets');
    Route::post('widgets/widget/{id}', 'WidgetController@updateWidget')->name('update.widget');
    Route::get('widgets/widget/delete/{id}/{index}', 'WidgetController@deleteWidget')->name('delete.widget');
    Route::get('widgets/widget/{id}/{index}', 'WidgetController@editWidget')->name('edit.widget');
    Route::post('widgets/widget', 'WidgetController@storeWidget');
    /**product Routes */
    Route::get('products', 'ProductController@productList')->name('product.list')->middleware('can:see-product');
    Route::get('products/get', 'ProductController@productListGet')->name('product.list.get');
    Route::get('product/select/item', 'ProductController@selectProduct')->name('product.select');
    Route::post('product/select/item', 'ProductController@getItemProduct')->name('get.item.product');
    Route::get('category/get/{id}', 'ProductController@getSubcategory');
    Route::get('product/insert/{id}', 'ProductController@index')->name('product.index')->middleware('can:create-product');
    Route::post('product/insert/{id}', 'ProductController@create')->name('product.create');
    Route::get('product/delete/{id}', 'ProductController@destroy')->name('product.destroy');
    Route::get('product/option/delete/{option_id}/{product_id}', 'ProductController@optionDelete')->name('product.option.delete');
    Route::get('product/item/delete/{id}', 'ProductController@itemDelete')->name('product.item.delete');
    Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('product/edit/{id}', 'ProductController@update')->name('product.update');
    /**product image Routes */
    Route::get('product/insert/image/{id}', 'ProductImageController@index')->name('product.image.index');
    Route::post('product/insert/image/{id}', 'ProductImageController@store')->name('product.image.store');
    Route::post('product/insert/image/{id}/edit', 'ProductImageController@update')->name('product.image.update');
    Route::get('product/delete/image/{id}', 'ProductImageController@destroy')->name('product.image.remove');
    /**menu Roures */
    Route::get('menus', 'MenuController@index')->name('menu.index')->middleware('can:see-menu');
    Route::post('menus', 'MenuController@store')->name('menu.store');
    Route::post('submenus', 'MenuController@SubMenuStore')->name('submenu.store');
    Route::delete('menuheader/{id}', 'MenuController@destroyMenuHeader')->name('menuheader.destroy');
    Route::get('menus/edit/{id}', 'MenuController@editMenu')->name('menu.edit');
    Route::post('menus/edit/{id}', 'MenuController@updateMenu')->name('menu.update');
    Route::delete('menu/delete/{id}', 'MenuController@destroyMenu')->name('menu.destroy');
    Route::get('menus/choose-page', 'MenuController@choosePage');
    /**Slideshow Route */
    Route::get('slideshows', 'SlideshowController@index')->name('slideshow.index')->middleware('can:see-slide');
    Route::post('slideshows', 'SlideshowController@store')->name('slideshow.store');
    Route::get('slideshows/delete/slide/{id}', 'SlideshowController@destroy')->name('product.slide.remove');
    /**Brands Route */
    Route::get('brands', 'BrandController@index')->name('brand.index');
    Route::post('brands', 'BrandController@store')->name('brand.store');
    Route::get('brands/delete/brand/{id}', 'BlideshowController@destroy')->name('brand.remove');
    /** Baner Route */
    Route::post('/baners', 'SlideshowController@Banerstore');
    /** admin-tickets Route */
    Route::get('/tickets', 'TicketController@index')->name('ticket.list')->middleware('can:see-message');
    Route::get('tickets/get', 'TicketController@listGet')->name('ticket.list.get');
    Route::get('/ticket/show/{id}', 'TicketController@show')->name('admin.ticket.show');
    Route::post('ticket/reply', 'TicketController@reply');
    /** User Route  */
    Route::get('users', 'UserController@index')->name('user.show')->middleware('can:see-user');
    Route::get('users/list', 'UserController@list');
    Route::get('users/role', 'UserController@roleIndex')->name('role.index');
    Route::post('users/role', 'UserController@roleStore');
    Route::get('users/role/list', 'UserController@roleList');
    Route::get('role/delete/{id}', 'UserController@roleDestroy')->name('role.destroy');
    Route::get('users/permission/{id}', 'UserController@permissionIndex')->name('permission.index');
    Route::post('users/permission/{id}', 'UserController@permissionStore')->name('permission.store');
    Route::post('users/insert-user-role', 'UserController@user_role');
    Route::get('users/delete-user-role/{user_id}/{role_id}', 'UserController@user_role_delete')->name('role.detach');
    Route::get('users/role/{id}/edit', 'UserController@roleEdit')->name('role.edit');
    Route::get('users/show/{id}', 'UserController@user_show')->name('user.profile.show');
    Route::get('users/show/{id}/order', 'UserController@user_show_order');
    /** admin-comments Route */
    Route::get('/comments', 'ProductCommentController@index')->name('comment.list')->middleware('can:see-comment');
    Route::get('comments/get', 'ProductCommentController@listGet')->name('comment.list.get');
    Route::get('/comment/show/{id}', 'ProductCommentController@show')->name('admin.comment.show');
    Route::post('comment/reply', 'ProductCommentController@reply');
    /** Settings Route */
    Route::get('/settings', 'SettingController@index')->name('setting.index')->middleware('can:see-setting');
    Route::post('/settings', 'SettingController@store')->name('setting.store');
    /** Post Route */
    Route::resource('post', 'PostController', ['except' => ['show'], 'middlware' => ['can:see-post']]);
    Route::get('post/category', 'PostController@category')->name('blog.category');
    Route::post('post/category', 'PostController@createCategory');
    Route::delete('post/category/{category}', 'PostController@destroyCategory');
    /** Discount Code */
    Route::get('discount-codes', 'DiscountCodeController@index')->name('code.index');
    Route::post('discount-codes', 'DiscountCodeController@store')->name('code.store');
    Route::get('discount-codes/{id}/delete', 'DiscountCodeController@destroy')->name('code.delete');
    /** visitors */
    Route::get('visitors', 'VisitorController@index')->name('visitor.index')->middleware('can:see-visitor');
    Route::get('visitors/user/{id}', 'VisitorController@user')->name('visitor.user');
    /** sell archive */
    Route::get('sell', 'SellController@index')->name('sell.index');
    Route::get('sell/list', 'SellController@sell_list');
    Route::get('sell/show/{id}', 'SellController@sell_show')->name('sell.show');
    Route::get('sell/agreepay/{id}', 'SellController@agreepay')->name('sell.agreepay');
    Route::post('sell/agreeOrder/{id}', 'SellController@agreeOrder')->name('sell.agreeOrder');
    /** Sell By Link Routes */
    Route::get('orders-by-link', 'SellByLinkController@index')->name('sellByLink.index');
    Route::get('sell-by-link/list', 'SellByLinkController@sellByLink_list');
    Route::get('orders-by-link/show/{id}', 'SellByLinkController@sell_show')->name('sellByLink.show');
    Route::post('orders-by-link/set-price/{id}', 'SellByLinkController@set_price')->name('sellByLink.setPrice');
    Route::post('orders-by-link/change-status/{id}', 'SellByLinkController@change_status')->name('sellByLink.changeStatus');
    /** depot */
    Route::get('depots', 'DepotController@index')->name('depot.index')->middleware('can:see-depot');
    ;
    /** Suggests */
    Route::get('suggest', 'SuggestController@index')->name('suggest.index');
    Route::post('suggest', 'SuggestController@store')->name('suggest.store');
    Route::get('suggest/delete/{id}', 'SuggestController@destroy')->name('suggest.destroy');
    /** SMS Routes !! */
    Route::get('sms/send', 'SmsController@send_show')->name('sms.send.show');
    Route::post('sms/send', 'SmsController@send_sms')->name('sms.send');
    Route::get('sms/add/group', 'SmsController@add_group')->name('sms.add.group.show');
    Route::post('sms/add/group', 'SmsController@add_group_store')->name('sms.add.group');
    Route::get('/sms/send/group', 'SmsController@send_group_show')->name('sms.send.group.show');
    Route::post('/sms/send/group', 'SmsController@send_group_sms')->name('sms.send.group');
    /**  send mail for newsletter accounts */
    Route::get('newsletter', 'UserController@newsletter_show')->name('newsletter.show');
    Route::post('newsletter', 'UserController@newsletter_send')->name('newsletter.store');

    /**    send post  to telegram with Bot */

    Route::get('telegram', function () {return view('Admin.telegram.telegram');})->name('telegram');
    Route::post('telegram', 'PostController@telegram')->name('telegram.send');

    /**
     * Checkout payment Routes
     */
    Route::get('/checkout', 'UserController@checkout')->name('checkout')->middleware('can:see-checkout');
    Route::post('/checkout', 'UserController@checkoutPayCart')->name('checkout.pay.cart')->middleware('can:see-checkout');
    Route::get('/checkout/status/agree/{refId}', 'UserController@checkoutStatusAgree');

    /**
     * Reports Pages in visits and financial
     */
    Route::get('/report/financial', 'ReportController@financialReport');
    Route::get('/report/visit', 'ReportController@visitReport');

    /**
     * Route Custom Page
     */
    Route::resource('page', 'PageController', ['except' => ['show']]);
});

/**
 * user info panel Routes !
 * Routes perfix is user
 * middleware is auth
 * namespace Front for controller
 */
Route::group(['prefix' => 'user', 'namespace' => 'Front', 'middleware' => ['auth', 'SiteDown']], function () {
    /** user-info Route */
    Route::get('/panel', 'UserPanelController@index')->name('user.panel');
    Route::get('/user-info', 'UserPanelController@user_info');
    Route::get('/edit-profile', 'UserPanelController@edit_profile')->name('user.edit');
    Route::post('/edit-profile', 'UserPanelController@save_profile');
    Route::get('/discount-code', 'UserPanelController@discountcode');
    /** user-tickets Route */
    Route::get('/ticket', 'TicketPanelController@index');
    Route::post('/ticket', 'TicketPanelController@store');
    Route::get('/ticket-form', 'TicketPanelController@create')->name('ticket.form');
    Route::get('/ticket-show/{id}', 'TicketPanelController@show')->name('ticket.show');
    /** user-address Route */
    Route::resource('addresses', 'AddressController');
    /** user order list**/
    Route::get('/orders/list', 'UserPanelController@orders')->name('user.orders');
    Route::get('/orders/show/{id}', 'UserPanelController@order_show')->name('user.order.show');
    Route::get('order/print/{id}', 'UserPanelController@order_print')->name('order.print');
});
/**
 * Menu Route in all views
 */

View::composer('Front.partials.menu', function ($view) {
    $view->with('menus', Menu::with('menuheader.submenu')->get());
});

View::composer('Front.partials.header', function ($view) {
    $view->with('setting', Setting::first());
});
View::composer('Front.master', function ($view) {
    $view->with('setting', Setting::first());
});
View::composer('Front.master', function ($view) {
    $view->with('theme', unserialize(Setting::first()->theme));
});
View::composer('Admin.master', function ($view) {
    $view->with('theme', unserialize(Setting::first()->theme));
});

View::composer('Front.partials.menu', function ($view) {
    $view->with('setting', Setting::first());
});
View::composer('Front.partials.footer', function ($view) {
    $view->with('setting', Setting::first());
});
View::composer('Admin.menu.menu', function ($view) {
    $view->with('comments', ProductComment::where("read", 0)->get());
});
View::composer('Admin.menu.menu', function ($view) {
    $view->with('tickets', Ticket::where("read", 0)->get());
});
View::composer('Admin.menu.menu', function ($view) {
    $view->with('orders', Order::where("status", 0)->get());
});

View::composer('Admin.menu.menu', function ($view) {
    $view->with('apiorder', ApiOrder::where("status", 0)->get()->count());
});

View::composer('Admin.menu.menu', function ($view) {
    $view->with('apichat', apiChat::where("read", 0)->get()->count());
});
