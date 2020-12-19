<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



use Sly\NotificationPusher\PushManager,
    Sly\NotificationPusher\Adapter\Apns as ApnsAdapter;

    use Sly\NotificationPusher\Collection\DeviceCollection,
    Sly\NotificationPusher\Model\Device,
    Sly\NotificationPusher\Model\Message,
    Sly\NotificationPusher\Model\Push;

Route::get('/', function () {
    return view('welcome');
});


Route::get('push2', function () {
	
	$pushManager = new PushManager(PushManager::ENVIRONMENT_DEV);


			$apnsAdapter = new ApnsAdapter(array(
			    'certificate' => app_path('pushcert_dev.pem'),
			    'passPhrase'  =>'1234',
			));
 
	
			$devices = new DeviceCollection(array(
			    new Device(\Input::get('token'))));

         $message = new Message('This is a basic example of push.');

	// Finally, create and add the push to the manager, and push it!
	$push = new Push($apnsAdapter, $devices, $message);
	$pushManager->add($push);
	$o = $pushManager->push();
	var_dump($o);

	foreach ($o->pushManager as $push) {
	    $response = $push->getAdapter()->getResponse();
	    var_dump($response);
	}


});

Route::post('push', function () {
	$o = PushNotification::app('appNameIOS');

	    $message = PushNotification::Message(\Input::get('message'),array("meta_data" => ['type' => "push"]));

	
	


           $o = $o->to(\Input::get('token'))
            ->send($message);
           
     
            foreach ($o->pushManager as $push) {
			    $response = $push->getAdapter()->getResponse();
			    var_dump($response);
			}

		

});


Route::post('pushAndroid', function () {
	$o = PushNotification::app('appNameAndroid');

	       $message = PushNotification::Message(\Input::get('message'),array("meta_data" => ["type" => "push"]));


//print_r($message);
           $o = $o->to(\Input::get('token'))
            ->send($message);
           

           
     
            foreach ($o->pushManager as $push) {
			    $response = $push->getAdapter()->getResponse();
			    var_dump($response);
			}

		

});

Route::get('help/api/v1/{page}', function ($page) {

	view()->share([
			'description' => 'Haggler Application', 
			'author' => 'Harcharan Singh', 
			'header_title' => 'Haggler API V1',
			'title' => 'Haggler API V1'
			]);

	return view('layouts.api');
});

Route::get('page/{slug}', 'Frontend\PageController@getIndex');

if (!function_exists('routes_collection')) {

	function routes_collection() {
		Route::group(['middleware' => 'acl'], function () {
			Route::controller('message', 'MessageController');
			Route::controller('redeem', 'RedeemController');
			Route::controller('page', 'PageController');
			Route::controller('sale', 'SaleController');
			Route::controller('marketing', 'MarketingController');
			Route::controller('slider', 'SliderController');
			Route::controller('event', 'EventController');
			Route::controller('store', 'StoreController');
			Route::controller('deal/category', 'DealCategoryController');
			Route::controller('deal', 'DealController');
			Route::controller('user', 'UserController');
			/*Route::controller('user', 'UserController');*/
			Route::controller('product', 'ProductController');
			Route::controller('category', 'CategoryController');
			Route::controller('dashboard', 'DashboardController');
			Route::controller('setting', 'SettingController');
			Route::controller('slider-image', 'SliderImageController');
			Route::controller('wallet', 'WalletController');
		});
		Route::controller('/', 'IndexController');
	}

}


Route::group(['prefix' => Config::get('admin_base', 'admin'), 'namespace' => 'Backend'], function () {
	
	routes_collection();

});


Route::group(['prefix' => Config::get('vendor_base', 'vendor'),'namespace' => 'Backend','middleware' => 'VendorMiddleware'], function () {
	
	routes_collection();

});






Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1'], function () {

	Route::controller('deal', 'DealController');
	Route::controller('user', 'UserController');
	Route::controller('/auth', 'AuthController');
	//Route::controller('/product', 'ProductController');


});

Route::group(['prefix' => 'user/WebServices', 'namespace' => 'Api\V0'], function () {

	Route::get('GetAllProducts', 'ProductController@getList');
	Route::get('GetAllProductCategories', 'ProductController@getCategories');
	Route::get('getAllProductsByCategoryId', 'ProductController@getList');
	Route::get('GetProductDetailsByProductId', 'ProductController@getView');
	Route::get('GetHomePageProducts', 'ProductController@getHomeItems');
    Route::get('GetProductLikes', 'ProductController@getproductLikes');
	Route::get('AddProductLikes', 'ProductController@productLikes');


	Route::get('SaveAddress', 'UserController@postAddress');
	Route::get('GetAddress', 'UserController@getAddress');
	Route::get('GetRewards', 'UserController@getRewards');
	Route::get('GetStoreDetails', 'UserController@store');
	Route::get('getDealById', 'UserController@getDeal');
	Route::post('deal/confirm', 'UserController@confirmDeal');
	Route::get('GetUserDeals', 'UserController@getUserDeals');
	Route::get('GetUserDealsById', 'UserController@getUserDealsById');
	Route::post('PostProfile', 'UserController@postProfile');
	Route::post('ChangePassword', 'UserController@changePassword');

	Route::get('login', 'AuthController@postLogin');
	Route::get('api/fblogin', 'AuthController@loginFacebook');
	
	Route::get('registration', 'AuthController@postRegister');
	Route::get('forgot-password', 'AuthController@getForgotPassword');
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	Route::get('GetProductDetailsByDealId', 'DealController@getView');
	Route::get('GetAllDeals', 'DealController@getList');
	Route::get('GetAllDealsCategories', 'DealController@getCategories');

	Route::get('GetAllEvents', 'EventController@all');
	Route::get('GetEventDetailsByEventId', 'EventController@view');
	
	Route::get('GetStoreDetails', 'CommonController@getStore');
	Route::get('searchAPI', 'CommonController@getSearch');
	Route::get('searchIn', 'CommonController@getSingleSearch');
	Route::get('GetStores', 'CommonController@getStores');
	
	Route::get('productSearch', 'CommonController@getProductSearch');
	Route::get('GetNearByDeals', 'CommonController@GetNearByDeals');
	Route::get('GetNearByUpdates', 'CommonController@getNearByUpdates');
	
	Route::get('updateDeviceInfo', 'UserController@updateDeviceInfo');
	Route::get('saveCartItem', 'UserController@addToCart');
	Route::get('GetCartItemsByUserId', 'UserController@getCartItems');
	Route::get('removeCartItem', 'UserController@removeFromCart');
	Route::get('setCartItemQty', 'UserController@setCartProductQty');

	Route::post('updateCartItems', 'UserController@updateCart');

	Route::get('followStore', 'UserController@followStore');
	Route::get('unfollowStore', 'UserController@unfollowStore');

	Route::get('followedStores', 'UserController@getFollowedStores');

	Route::get('conversation', 'UserController@getMessageThread');
	//Route::get('delete-conversation', 'UserController@getDeleteMessageThread');
	Route::get('messages', 'UserController@getMessages');
	Route::get('message', 'UserController@getMessage');
	Route::post('message/send', 'UserController@sendMessage');

	Route::get('page', 'CommonController@getPage');
	Route::get('pages', 'CommonController@getPages');
	Route::post('contact_us', 'CommonController@postContact');

	Route::post('order/create', 'UserController@createOrder');
	Route::post('order/confirm', 'UserController@confirmOrder');
	Route::get('order/history', 'UserController@getOrders');
	Route::get('order/view', 'UserController@getOrder');
	Route::get('order/verify', 'UserController@getOrderVerify');

	Route::get('buzline/alerts', 'UserController@buzlineAlerts');
	Route::get('buzline/data', 'UserController@getBuzlineData');
	Route::get('pincode/validate', 'SettingController@getPincodeValidate');
	
});


