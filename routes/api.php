<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['namespace' => 'Api'],

    function () {
        Route::get('register/{mobile}', 'UserController@mobile');
        Route::post('login', 'UserController@login');
        Route::get('categories', 'ShopController@categories');
        Route::get('subcategories/{slug}', 'ShopController@subcategories');
        Route::get('products/{category_slug}/{subcategory_id}', 'ShopController@products');
        Route::get('category/products/{category_slug}', 'ShopController@category_products');
        Route::get('slideshows', 'ShopController@slideshows');
        Route::get('discount-products', 'ShopController@discount_products');
        Route::get('products/suggest', 'ShopController@suggest');
        Route::get('products/lastItems', 'ShopController@lastItem');
        Route::get('products/search', 'ShopController@search');
        Route::get('app/status', 'UserController@app_status');
        Route::get('app/version', 'UserController@app_version');
        Route::get('products/search', 'ShopController@search');
        Route::any('callback/order/from/bank/{id}/{user}', 'OrderController@payment_callback')->name('api.order.callback');
    });
Route::group(['middleware' => ['auth:api'], 'namespace' => 'Api'], function () {
    Route::get('forgetBasket', 'OrderController@forgetBasket');
    Route::post('getbasket', 'OrderController@getBasket');
    Route::post('getorder', 'OrderController@store');
    Route::get('/user/history', 'OrderController@history');
    Route::post('/chat/store', 'ChatController@chatStore');
    Route::get('/chat/getChats', 'ChatController@getChats');
    Route::get('order/request/{id}/{price}', function ($id, $price) {
        try {
            //dd(Crypt::decrypt($price));
            $gateway = \Gateway::Zarinpal();
            $gateway->setCallback(route('api.order.callback', ['id' => $id, 'user' => Crypt::encrypt(Auth::user()->id)]));
            $gateway->price(Crypt::decrypt($price))->ready();
            $refId = $gateway->refId();
            $transID = $gateway->transactionId();
            return $gateway->redirect();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    })->name('api.order.payment');
});
Route::middleware('auth:api')->get('/user',
    function (Request $request) {
        return $request->user();
    });

/**
 * Vue Web Application Routes
 */
Route::group(['namespace' => 'Vue', 'prefix' => 'web', 'middleware' => ['SiteDown']],
    function () {
        /**
         * Login and Register User
         */
        Route::post('login', 'UserController@login');
        Route::post('register', 'UserController@register');
        /**
         * Return HomePage widgets and Setting
         */
        Route::get('homepage', 'PagesWidgetController@homePage');
        Route::get('settings', 'PagesWidgetController@settings');
        /**
         * Return Product Details
         */
        Route::get('product/{slug}', 'PagesWidgetController@productPage');
        /**
         * checkDiscount
         */
        Route::post('order/disount/check', 'OrderController@discountCheck');
        /**
         * Products List
         */
        Route::get('list/{category_slug}', 'PagesWidgetController@categoryProduct');
        Route::get('list/{category_slug}/{sub_slug}/{sort?}', 'PagesWidgetController@subcategoryProduct');
        /**
         * filter products  by price,brands,subcategory
         */
        Route::post('filter/products/{category_id}', 'PagesWidgetController@filterProduct');
        /**
         * newsletter Users
         */
        Route::post('newsletter', 'UserController@newsletter');
        /**
         * Categories Page
         */
        Route::get('categories', 'PagesWidgetController@CategoryPage');
        /**
         * Products By Brands
         */
        Route::get('brands/{slug}', 'PagesWidgetController@BrandPage');
        /**
         * Blog Posts
         */
        Route::get('blog/posts/{slug}', 'PagesWidgetController@BlogPostPage');
        /**
         * Blog Single Page
         */
        Route::get('/blog/post/{id}', 'PagesWidgetController@BlogPostSingle');
        /**
         * Blog Search
         */
        Route::post('/blog/search', 'PagesWidgetController@BlogPostSearch');
        /**
         * Product Search
         */
        Route::post('/search', 'PagesWidgetController@Search');
        /**
         * Contact us Save
         */
        Route::post('/contact', 'PagesWidgetController@Contact');
        /**
         * Download file Routes  for public and private
         */
        Route::get('/file/download/{id}', 'OrderController@downloadPublic')->name('downloadPublic');
        Route::get('/file/download/{id}/{order_d}', 'OrderController@downloadPrivate')->name('downloadPrivate');
        /**
         * Custom page Routes  example => aboutus
         */
        Route::get('page/{slug}', 'PagesWidgetController@Page');
        /**
         * Province and Cities list
         */
        Route::get('province-list', 'OrderController@provinceList');
        Route::get('cities-list/{id}', 'OrderController@citiesList');
        /**
         * order by link Routes
         */
        Route::post('orderByLink-save', 'OrderByLinkController@OrderByLinkCreate');
        Route::post('orderByLink-tracking', 'OrderByLinkController@OrderByLinkTracking');
        Route::get('orderByLink/request/{id}', 'OrderByLinkController@redirectGateway');
        Route::any('callback/orderByLink/from/bank/{id}', 'OrderByLinkController@payment_callback')->name('api.orderByLink.callback');
    });

Route::group(['namespace' => 'Vue', 'prefix' => 'web', 'middleware' => ['auth:api', 'SiteDown']],
    function () {
        /**
         * User Details and info for User menu
         */
        Route::get('user/detail', 'UserController@UserDetail');
        Route::post('user/detail', 'UserController@UserDetailStore');
        Route::get('user/info', 'UserController@UserInfo');
        /**
         * User Address Store and Show
         */
        Route::get('user/address', 'AddressController@UserAddress');
        Route::post('user/add/address', 'AddressController@UserAddAddress');
        Route::get('user/address/{id}/edit', 'AddressController@UserEditAddress');
        Route::post('user/address/{id}/edit', 'AddressController@UserEditAddressStore');
        Route::get('user/address/{id}/remove', 'AddressController@UserRemoveAddress');
        Route::get('user/address/list', 'AddressController@UserAddressList');
        /**
         * User Tickets URl
         */
        Route::get('user/ticket', 'TicketController@index');
        Route::post('user/ticket', 'TicketController@TicketStore');
        Route::get('user/ticket/show/{id}', 'TicketController@TicketShow');
        Route::post('user/ticket/message/{id}', 'TicketController@TicketMessageStore');
        /**
         * Order Routes
         */
        Route::get('user/orders', 'UserController@OrderList');

        /**
         * User WishList Routes
         */
        Route::get('user/wishlist', 'WishController@WishList');
        Route::get('user/wishstore/{id}', 'WishController@WishStore');
        Route::get('user/wishremove/{id}', 'WishController@WishRemove');
        /**
         * Store Comment For Products
         */
        Route::post('product/commentstore/{id}', 'PagesWidgetController@commentStore');
        /**
         * Store User Order :)
         */
        Route::post('order-submit', 'OrderController@store');
        /**
         * Return Order Detail
         */
        Route::get('/order-details/{id}', 'OrderController@OrderDetails');
    });
