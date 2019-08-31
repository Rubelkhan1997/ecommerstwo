<?php
// Frontend Links
Route::get('/','FrontendController@index');
Route::get('contact','FrontendController@contact');
Route::get('about','FrontendController@about');
Route::get('product/details/{product_id}','FrontendController@productdetails');
Route::get('category/page/view/{category_id}','FrontendController@categorypageview');
Route::get('add/to/card/{product_id}','FrontendController@addtocard');

Route::get('card/page','CardController@cardpage');
Route::get('card/page/{coupon_name}','CardController@cardpage');
Route::get('card/clear','CardController@cardclear');
Route::post('card/update','CardController@cardupdate');

Route::get('single/product/delete/{product_id}','CardController@singleproductdelete');
Route::get('single/product/delete/{product_id}','CardController@singleproductdelete');

Route::get('customer/registation/form','FrontendController@customerregistationform');
Route::post('customer/registation/form/post','FrontendController@customerregistationformpost');

Route::post('checkout','FrontendController@checkout');
Route::post('shipping_address','FrontendController@shippingaddress');

Route::post('city/list','FrontendController@citylist');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Backend Links

Route::get('product/inset/form','ProductController@productinsertform');
Route::post('product/insert/form/post','ProductController@productinsertformpost');
Route::get('product/delete/{product_id}','ProductController@productdelete');
Route::get('product/edit/{product_id}','ProductController@productedit');
Route::post('product/edit/post','ProductController@producteditpost');


Route::get('category/insert/form','CategoryController@categoryinsertform');
Route::post('category/insert/form/post','CategoryController@categoryinsertformpost');
Route::get('categorydelete/{category_id}','CategoryController@categorydelete');
Route::get('category/edit/form/{category_id}','CategoryController@categoryeditform');
Route::post('category/edit/form/post','CategoryController@categoryeditformpost');


Route::get('coupon/insert/form','CouponController@couponinsertform');
Route::post('coupon/insert/form/post','CouponController@couponinsertformpost');
Route::get('coupan/item/delete/{coupon_id}','CouponController@coupanitemdelete');

Route::get('slider/insert/form','SliderController@sliderinsertform');
Route::post('slider/insert/form/post','SliderController@sliderinsertformpost');



//Customer dashbord
Route::get('customer/dashbord','CustomerController@customerdashbord');
Route::get('customer/profile/form','CustomerController@customerprofileform');
Route::post('customer/profile/form/post','CustomerController@customerprofileformpost');
Route::post('customer/profile/form/update/post','CustomerController@customerprofileformupdatepost');
Route::get('customer/order','CustomerController@customerorder');
Route::get('customer/product/view/{shipping_id}','CustomerController@customerproductview');


//Stripe payment

Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
