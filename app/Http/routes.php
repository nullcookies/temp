<?php
/*
	[code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

// social login
$s = 'social.';
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect',   'uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => $s . 'handle',     'uses' => 'Auth\SocialController@getSocialHandle']);

// custom login
Route::auth();

Route::post('customregisteruser','Auth\CustomauthController@customregister');

// change password
Route::post('change-password', 'Auth\UpdatePasswordController@update');

// ajax login
Route::post('/ajaxLogin','Auth\CustomauthController@postLogin');
Route::post('/ajaxRegister','Auth\CustomauthController@postRegister');
// ajax login

Route::get('/loginwithoutpassword','Auth\CustomauthController@loginwithoutpassword');

Route::get('/confirm-otp','Auth\CustomauthController@confirmotp');
Route::post('/confirm-otp','Auth\CustomauthController@verifyotp');
Route::post('/sendotp','Auth\CustomauthController@sendotp');

Route::group(['namespace' => 'Massengers'], function(){
	Route::get('/','Homepage\HomepageController@homepage');
	Route::get('/need-today','Needtoday\NeedtodayController@needtoday');
	Route::get('/contact-us','Contactus\ContactusController@contactus');
	
	// save contact-us data
	Route::post('/contact-us','Contactus\ContactusController@saveData');
	
	Route::get('/track-order','Trackorder\TrackorderController@trackorder');
	Route::get('/lovers-mantra','Loversmantra\LoversmantraController@loversmantra');
	Route::get('/love-birds','Lovebirds\LovebirdsController@lovebirds');
	Route::get('/love-confession-board','LoveConfessionBoard\LoveConfessionBoardController@loveconfessionboard');
	// save love confession
	Route::post('saveloveconfession','LoveConfessionBoard\LoveConfessionBoardController@saveloveconfession');
	
	// reply on love confession
	
	Route::post('replyconfession','LoveConfessionBoard\LoveConfessionBoardController@givereply');
	Route::get('/terms-and-conditions','TermsAndCondition\TermsAndConditionController@termsandconditions');
	Route::get('/disclaimer','Disclaimer\DisclaimerController@disclaimer');
	Route::get('/privacy-policy','PrivacyPolicy\PrivacyPolicyController@privacypolicy');
	Route::get('/about-us','AboutUs\AboutUsController@aboutus');
	Route::get('/career','Career\CareerController@career');
	Route::get('/checkout2','Checkout\CheckoutController@checkout2');
	Route::get('/checkout3','Checkout\CheckoutController@checkout3');
	Route::get('/checkout4','Checkout\CheckoutController@checkout4');
	Route::get('/help','Help\HelpController@help');
	Route::get('/cart','Cart\CartController@cart');
	Route::get('/category/{categoryid}','Product\ProductController@categoryproduct');
	Route::get('category/{categoryid}/product/{productid}','ProductDetail\ProductDetailController@productdetail');
	// validate before checkout
	Route::post('/validatebeforecheckout','ProductDetail\ProductDetailController@validatebeforecheckout');
	// checkout
	Route::get('/product/checkout/{buynowid}','Checkout\CheckoutController@checkout');
	//save customer address ajax
	Route::post('/savecustomeraddressajax','Address\AddressController@savecustomeraddressajax');
	Route::post('/fetchaddressajax','Address\AddressController@fetchaddressajax');
	//save delivery details
	Route::post('/save_delivery_details','Checkout\CheckoutController@save_delivery_details');
	// delete buy now products
	Route::post('/delete_checkout_product','Checkout\CheckoutController@delete_checkout_product');
	// do proceed to pay
	Route::post('/proceed_to_pay','Checkout\CheckoutController@proceed_to_pay');
	// go back to delivery details
	Route::post('/go_back_to_delivey_details','Checkout\CheckoutController@go_back_to_delivey_details');
	// add to cart
	Route::post('/add_to_cart','Cart\CartController@add_to_cart');
	// delete cart item
	Route::post('/delete_cart_item','Cart\CartController@delete_cart_item');
	// checkout by cart
	Route::post('/checkout_by_cart','Cart\CartController@checkout_by_cart');
	// redirect to payment gateway
	Route::get('/gotopaymentgateway/{buynowid}','Checkout\CheckoutController@gotoPaymentGateway');
    // callback url 
    Route::post('indipay/getsuccess','Checkout\CheckoutController@getsuccessresponse');
    Route::post('indipay/getcancel','Checkout\CheckoutController@getcancelresponse');
    
    // order success page
    Route::get('order/success/{orderid}','Checkout\CheckoutController@ordersuccess');
    
    // search
	Route::get('/search','ProductSearch\ProductSearchController@search');
	
	// newsletter
	Route::post('/savenewsletter','Newsletter\NewsletterController@saveNewsletter');
	
	//corporate page
	Route::get('/corporate','Corporate\CorporateController@showcorporate');
	
	//corporate detail page
	Route::get('/bulk-order','Corporate\CorporateController@bulkOrder');
	
	//profile page
	Route::get('/profile','Profile\ProfileController@showProfile');
	
	// checkout product image upload 
	Route::post('uploadcheckoutproductimage','ProductDetail\ProductDetailController@uploadImage');
	
	// get notification products
	Route::get('/getnotificationproducts','ProductDetail\ProductDetailController@getnotificationproducts');
	
	// pincodes fetch
	
	Route::get('/fetchpincode','ProductDetail\ProductDetailController@fetchpincode');
	
	// suggest pincode
	
	Route::get('/suggestpincode','ProductDetail\ProductDetailController@suggestpincode');
	
	// get all cart products
	
	Route::get('/cartcount','Cart\CartController@getcartcount');
	
	//fetch confessions
	
	Route::get('/fetchconfessionjscroll','LoveConfessionBoard\LoveConfessionBoardController@fetchconfessionjscroll');
	
	// fetch Confession reply
	
	Route::get('/fetchconfessionreply/{confessionid}','LoveConfessionBoard\LoveConfessionBoardController@fetchconfessionreplyjscroll');
	
	// get likes on confession
	
	Route::post('getlike','LoveConfessionBoard\LoveConfessionBoardController@getlike');
	
	// track order
    
    Route::post('/trackorder','Trackorder\TrackorderController@orderstatus');

    // fetch delivery options

    Route::get('/fetchdeliveryoptions/','ProductDetail\ProductDetailController@fetchdeliveryoptions');

    // fetch delivery calender

    Route::get('/fetchdeliverycalender','ProductDetail\ProductDetailController@fetchdeliverycalender');
    
    // fetch delivery time
    
    Route::get('/fetchdeliverytimings','ProductDetail\ProductDetailController@fetchdeliverytimings');
    
    // get edit profile info
    
    Route::post('/updateprofile','Profile\ProfileController@updateprofile');
    
    // update profile image
    
    Route::post('/uploadprofileimage','Profile\ProfileController@uploadprofileimage');
});


Route::group(['prefix' => ADMIN_URL_PATH, 'namespace' => 'Admin', 'middleware' => 'isadmin'], function () {
	/*admin*/
	Route::get('/banners','Banner\BannerController@index');
	Route::post('/savebanners','Banner\BannerController@saveBanner');
	Route::post('/banners/delete','Banner\BannerController@deleteBanner');
	/*admin*/

	Route::get('/','Homepage\DashboardController@index');
	Route::get('/user_management','User\UserManagementController@index');
	Route::delete('/user_management','User\UserManagementController@deleteUser');
	Route::post('/reset_password','User\UserManagementController@reset_password');
	Route::get('/create_user','User\UserManagementController@create_user');
	Route::post('/create_user','User\UserManagementController@save_user');
	Route::post('/update_basic_info','User\UserManagementController@edit_user_basic_info');
	Route::post('/update_access_mode','User\UserManagementController@update_access_mode');
	Route::post('/update_user_type','User\UserManagementController@update_user_type');
	Route::get('/payments/charts',['as'=>'charts','uses'=>'Payment\paymentController@charts_data']);
    Route::get('/payments',['as'=>'payments','uses'=>'Payment\paymentController@get_payment_page']);
    Route::get('/get_commision',['as'=>'get_commision','uses'=>'Payment\paymentController@calculate_gmv']);
	Route::get('/get_unbiled_amount',['as'=>'get_unbiled_amount','uses'=>'Payment\paymentController@calculate_unbiled_amount']);
Route::get('/put_biled_amount',['as'=>'put_biled_amount','uses'=>'Payment\paymentController@addData_to_billed_account']);
Route::get('/get_unbilled_ammount_from_table',['as'=>'get_unbilled_ammount_from_table','uses'=>'Payment\paymentController@get_unbilled_ammount_from_table']);
Route::get('/get_billed_ammount_from_table',['as'=>'get_billed_ammount_from_table','uses'=>'Payment\paymentController@get_billed_ammount_from_table']);
Route::get('/add_data_to_referecnce_table',['as'=>'add_data_to_referecnce_table','uses'=>'Payment\paymentController@addDataToHistoryTable']);
Route::get('/get_data_from_reff_show_table',['as'=>'get_data_from_reff_show_table','uses'=>'Payment\paymentController@getDataToReffTable']);
Route::get('/view_all_from_reff_cntrl',['as'=>'view_all_from_reff_cntrl','uses'=>'Payment\paymentController@view_all_from_reff_cntrl']);
Route::get('/details/{id?}',['as'=>'details','uses'=>'Payment\paymentController@details']);
Route::get('/details_order/{id1?}/{id?}',['as'=>'details_order','uses'=>'Payment\paymentController@details_order']);
Route::get('/dounload_csv/{id?}',['as'=>'dounload_csv','uses'=>'Payment\paymentController@dounload_csv']);
	Route::group(['namespace' => 'Trial'], function(){
		Route::get('list_trials','TrialController@showList');
		Route::get('getlist','TrialController@getlist');
		Route::post('deletelist','TrialController@deleteTrial');
	});

	Route::group(['prefix' => '/shipping_charges', 'namespace' => 'ShippingCharges'], function () {
		Route::get('/','ShippingChargesController@index');
		Route::post('/get_modal_content','ShippingChargesController@get_modal_content');
		Route::post('/saveShippingCharges','ShippingChargesController@save_shipping_charges');
		Route::post('/update_pincodes','ShippingChargesController@update_pincodes');
		Route::post('/edit_zone_detail','ShippingChargesController@edit_zone_detail');
		Route::post('/delete_zone','ShippingChargesController@delete_zone');
		Route::post('/fetch_pincode','ShippingChargesController@fetch_pincode');
	});

	// new module
	Route::group(['prefix' => '/coupon', 'namespace' => 'Coupon'], function () {
		Route::get('/','CouponController@index');
		Route::get('/create','CouponController@create');
		Route::post('create','CouponController@save');
		Route::delete('/delete_coupon','CouponController@delete');
		Route::post('change_status','CouponController@change_status');
		Route::get('edit_coupon','CouponController@update_coupon');
		Route::post('edit_coupon','CouponController@save_updated_data');
	});

	//add product, edit, delete and all the stufs related to products will available here
	Route::group(['prefix' => '/product', 'namespace' => 'Product'], function () {
		Route::get('/','ProductController@index');
		Route::get('/upload','ProductController@uploadProduct');
		Route::get('/create','ProductController@create');
		Route::post('/save','ProductController@save');
		Route::get('/bulkUpload','ProductController@showBulkupload');
		Route::post('/bulkUpload','ProductController@upload_by_csv');
		Route::post('/fetchCategory','ProductController@fetchCategory');
		Route::post('/setupCategory','ProductController@setupcategory');
		Route::get('/uploadByLink','ProductController@uploadFromLink');
		Route::post('/uploadByLink','ProductController@getparse');
		Route::get('/editProduct','ProductController@editProduct');
		Route::post('/editProduct','ProductController@saveEditProduct');
		Route::delete('/','ProductController@deleteProduct');

		/* upload images and get links */

		Route::get('/uploadImages','ProductHelper@uploadMultipleImages');
		Route::post('/uploadImages','ProductHelper@saveMultipleImages');
		
		/* product image multi upload */

		Route::post('/multiimageUpload','ProductController@uploadMultiImages');
		
		/* Code By Jaymani Start*/		
		Route::post('/ajax/ajaxcall','ProductController@ajaxcall');
		Route::get('/productimages','ProductController@productimages');
		Route::post('/productimages','ProductController@imageUploadPost');
		Route::get('/imagescrop','ProductController@imagescrop');
		Route::post('/imagescrop','ProductController@saveimagescrop');
		Route::get('/deleteimage','ProductController@deleteimage');
		Route::get('/inventory','ProductController@inventory');
		Route::post('/inventory','ProductController@inventoryupdate'); 
		
		/* new inventory route*/
		Route::post('/updateInventory','ProductController@updateInventory'); 
		/* new inventory route ends*/

		Route::get('/importExport', 'ProductController@importExport');
		Route::get('/downloadExcel/{type}', 'ProductController@downloadExcel');
		Route::post('/importExcel', 'ProductController@importExcel');	
		Route::get('deleted', 'ProductController@deleted');
		Route::delete('deleted/{id}','ProductController@permanentDeleteProduct');
		Route::post('deleted','ProductController@restoreProduct');

		Route::resource('homepagetag','HomepageTagController');
		
		Route::get('/addTagProducts/{id}', 'HomepageTagController@addTagProducts');
		Route::post('/addTagProducts/{id}', 'HomepageTagController@postTagProducts');
		Route::get('/editTagProducts/{id}', 'HomepageTagController@editTagProducts');
		Route::post('/editTagProducts/{id}', 'HomepageTagController@updateTagProducts');
		Route::delete('/deleteTagProducts/{id}', 'HomepageTagController@deleteTagProducts');
		Route::get('/product-hot-deal', 'HomepageTagController@producthotdeal');
		Route::get('producthotdealcreate', 'HomepageTagController@producthotdealcreate');
		Route::get('producthotdealedit/{id}', 'HomepageTagController@producthotdealedit');
		Route::post('producthotdeal', 'HomepageTagController@producthotdealstore');
		Route::post('producthotdealedit/{id}', 'HomepageTagController@producthotdealupdate');
		Route::delete('producthotdeal/{id}', 'HomepageTagController@producthotdealdestroy');
		/* Code By Jaymani End*/
	});

	Route::group(['prefix' => '/commission', 'namespace' => 'Commission'], function () {
		Route::get('/','CommissionController@index');
		Route::post('/getCategories','CommissionController@fetchCategory');
		Route::post('/saveCommission','CommissionController@saveCommission');
		Route::post('/saveStandCommission','CommissionController@saveStandCommission');
		Route::post('/deleteStandCommission','CommissionController@deleteStandCommission');
		Route::post('/saveCatCommission','CommissionController@saveCatCommission');
		Route::post('/postStandard','CommissionController@postStandard');
		Route::post('/setdefaultcategory','CommissionController@setDefaultCategory');
	});

	Route::group(['prefix' => 'new_commission', 'namespace' => 'NewCommission'], function(){
		Route::get('/','CommissionController@showPage');
		Route::get('/getShowData','CommissionController@getShowData');
	});

	Route::group(['prefix' => '/assign_varients','namespace' => 'Varients'],function(){
	/* Code By Jaymani Start*/
		Route::get('/','AssignVarientsController@index');
		Route::post('/getProductVarient','AssignVarientsController@getProductVarient');
		Route::post('/','AssignVarientsController@postProductVarient');		
		Route::delete('/','AssignVarientsController@deleteProductVarient');		
	/* Code By Jaymani End*/
		Route::post('/insertValueToVarient','AssignVarientsController@insertValueToVarient');
		Route::post('/selectProductVarientValue','AssignVarientsController@selectProductVarientValue');
		Route::post('/getAllAvailableVarientValue','AssignVarientsController@getAllAvailableVarientValue');
		Route::post('/removeSelectedVarientValue','AssignVarientsController@removeSelectedVarientValue');
		Route::post('/getAllSelectedVarients','AssignVarientsController@getAllSelectedVarients');
		
	});	
	/* Code By Jaymani Start*/
	Route::group(['prefix' => '/orders','namespace' => 'Orders'],function(){
		Route::get('/view','OrdersController@index');
		Route::delete('/view','OrdersController@deleteorder');
		Route::get('/admin-order','OrdersController@create');		
		Route::post('/admin-order','OrdersController@postOrder');
		Route::post('/showcity','OrdersController@ajaxShowCity');
		Route::post('/setProductData','OrdersController@setProductData');
		Route::get('/addproduct/{id}','OrdersController@addproduct');
		Route::post('/addproduct','OrdersController@updateProduct');
		Route::get('/manifest', 'OrdersController@manifest');		
		Route::get('/shippinglabel/{id}','OrdersController@shippinglabel');
		Route::get('/manifestlabel/{id}','OrdersController@manifestlabel');
		Route::get('/return','OrdersController@orderRreturn');
		Route::post('/updateStatus','OrdersController@updateStatus');
		Route::get('/orderDispatch','OrdersController@orderDispatch');
		Route::get('/orderShipped','OrdersController@orderShipped');
		Route::get('/orderDelivered','OrdersController@orderDelivered');
		Route::get('/signedmanifest/{id}','OrdersController@signedmanifest');
		Route::post('/signedmanifest','OrdersController@postsignedmanifest');
		Route::get('/shipped/{id}','OrdersController@shipped');
		Route::get('/completed/{id}','OrdersController@completed');	
		Route::post('/ajaxUpdate', 'OrdersController@ajaxUpdate');
		Route::post('/admin/orders/productVarientPrice', 'OrdersController@ajaxProductVarientPrice');
		Route::get('returnorder', 'OrdersController@orderReturn');
		
		/* new appended */
		Route::post('/bulkMenifest','OrdersController@saveBulkMenifest');
		Route::get('/bulkMenifest','OrdersController@showBulkMenifest');
		
		/* latest */
		Route::get('/trackOrder/{orderid}','OrdersController@trackOrder');
		Route::get('/trackOrders','OrdersController@trackOrderRequest');
		
		/* new */
		Route::get('/invoice/{orderid}','OrdersController@getInvoice');
		
	});
	
	Route::group(['prefix' => '/category', 'namespace' => 'Category'], function(){
		Route::get('/','CategoryController@index');
		Route::get('/add','CategoryController@create');
		Route::post('/save','CategoryController@save');
		Route::post('/subCategory','CategoryController@subCategory');
		Route::post('/ajax/ajaxflag','CategoryController@ajaxCall');
		Route::get('/categorylist','CategoryController@categorylist');
		Route::get('/edit/{id}','CategoryController@edit');
		Route::delete('/','CategoryController@deletecategory');
		Route::post('/edit/{id}','CategoryController@update');
		Route::post('/editparentcat/{id}','CategoryController@updateparentcategory');
	});
	Route::group(['prefix' => '/categorysynch', 'namespace' => 'Category'], function(){
		Route::get('/', 'CategoryController@getCategorysynch');
		Route::post('/apicategory', 'CategoryController@ajaxSynchCategory'); // ajax call for category synchronization
		Route::post('/', 'CategoryController@postSynchCategory');
	});
	Route::group(['prefix' => '/message', 'namespace' => 'Contact'], function(){
		Route::get('/', 'ContactController@index');
		Route::get('mail-me', 'ContactController@mailme');
		Route::get('center', 'ContactController@messagCenter');
		Route::post('postcontact', 'ContactController@postcontact');
	});
	/* Code By Jaymani End */

	Route::group(['prefix' => '/setting','namespace' => 'Setting'],function(){
		Route::get('/','SettingController@index');
		Route::post('/savePersonalInfo','SettingController@savePersonalInfo');
		Route::post('/saveBusinessInfo','SettingController@saveBusinessInfo');
		Route::post('/savePickupDetail','SettingController@savePickupDetail');
		Route::post('/savebankDetails','SettingController@savebankDetails');
	});

	Route::group(['prefix' => '/website-analytics','namespace' => 'WebsiteAnalytics'], function(){
		Route::get('/','WebsiteAnalyticsController@showWebsiteAnalysis');
	});

	Route::get('/notices','StaticPage\StaticPagesController@notices');
	Route::get('/service-agreements','StaticPage\StaticPagesController@serviceAgreements');
	Route::get('/review','StaticPage\StaticPagesController@review');

	// my subscription
	Route::get('/my-subscriptions','Subscription\MySubscriptionController@showMySubscriptions');
	Route::get('/all-subscriptions','Subscription\SubscriptionController@showList');
	Route::get('/create_subscription','Subscription\SubscriptionController@createNew');
	Route::get('/getCityAjax','Subscription\SubscriptionController@getCityAjax');
	Route::get('/getPriceAjax','Subscription\SubscriptionController@getPriceAjax');
	Route::post('/saveSubscription','Subscription\SubscriptionController@saveSubscription');
	Route::post('/changeSubscriptionStatusAjax','Subscription\SubscriptionController@changeSubscriptionStatusAjax');

	Route::group(['prefix' => '/rm', 'namespace' => 'RelationshipManager'], function(){
		Route::get('/create','RelationshipManagerController@create');
		Route::post('/makeRmAjax','RelationshipManagerController@makeRmAjax');
		Route::post('/removeRmAjax','RelationshipManagerController@removeRmAjax');
		Route::post('/assignRmAjax','RelationshipManagerController@assignRmAjax');
	});

	Route::group(['prefix' => 'domain_request', 'namespace' => 'DomainRequest'], function(){
		Route::post('/create','DomainRequestController@create');
		Route::get('/','DomainRequestController@index');
		Route::post('/change_status_ajax','DomainRequestController@change_status_ajax');
	});
	
	Route::get('/postNotification','Pages\PagesController@showNotificationAdminPage');
	Route::post('/postNotification','Pages\PagesController@saveNotification');


	Route::group(['prefix' => '/website-setting','namespace' => 'WebsiteSetting'], function(){
		Route::get('/','WebsiteSettingController@index');
		Route::get('/add', 'WebsiteSettingController@add');
		Route::get('/sliders', 'WebsiteSettingController@sliders');
		Route::post('/add', 'WebsiteSettingController@updateImage');
		Route::post('/sliders', 'WebsiteSettingController@updateSliders');
		Route::post('/imagedelete', 'WebsiteSettingController@imagedelete');
	});
	Route::group(['prefix' => '/socialmedia','namespace' => 'WebsiteSetting'], function(){
		Route::get('/', 'WebsiteSettingController@showlist');
		Route::get('/addsocial', 'WebsiteSettingController@addsocial');
		Route::post('/addsocial', 'WebsiteSettingController@postsocial');
		Route::get('/editsocial/{id}', 'WebsiteSettingController@editsocial');
		Route::post('/editsocial/{id}', 'WebsiteSettingController@updateocial');
		Route::delete('/', 'WebsiteSettingController@deletesocial');
	});
	
	
	Route::get('jcrop', 'WebsiteSetting\WebsiteSettingController@postjcrop');
	Route::post('jcrop/save', 'WebsiteSetting\WebsiteSettingController@savejcrop');
	Route::resource('pages','WebsiteSetting\HomepagePagesController');
	Route::resource('testimonials','WebsiteSetting\TestimonialsController');
	Route::group(['prefix' => '/homepage','namespace' => 'WebsiteSetting'], function(){
		Route::get('/', 'HomepageSettingController@index');
		Route::post('/', 'HomepageSettingController@homesetting');
		
		Route::get('/nav','HomepageNavController@shownav');
		Route::post('/saveNewCategory','HomepageNavController@saveNewCategory');
		Route::get('/getAddCategoryModelContent','HomepageNavController@getAddCategoryModelContent');
		Route::post('/editCategory','HomepageNavController@editCategory');
		Route::get('/getEditCategoryModelContent','HomepageNavController@getEditCategoryModelContent');
		Route::post('/deleteCategory','HomepageNavController@deleteCategory');
		Route::get('/getDeleteCategoryModelContent','HomepageNavController@getDeleteCategoryModelContent'); 
	});

	/*Route::get('imageform', 'Setting\SettingController@imageform');
	Route::post('imageform', 'Setting\SettingController@postimageform');
	Route::get('jcrop', 'Setting\SettingController@jcrop');
	Route::post('jcrop', 'Setting\SettingController@postjcrop');*/
	
});

	