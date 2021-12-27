<?php

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

Route::get('/', 'HomeController@welcome')->name('home');
Route::get('/contuct-us', 'HomeController@contuct_us')->name('contuct_us');
Route::post('/contuct-form', 'HomeController@contuct_form')->name('contuct_form');
Route::get('/category', 'HomeController@all_category')->name('all_category');
Route::get('/brand', 'HomeController@all_brand')->name('all_brand');
Route::get('/brand/{slug}', 'HomeController@brand')->name('brand');
Route::get('/type/{slug}', 'HomeController@product_type')->name('product_type');
Route::get('/best-selling', 'HomeController@BestSelling')->name('best.selling');
Route::get('/new-arrival', 'HomeController@NewArrival')->name('new.arrival');
Route::get('/popular-product', 'HomeController@popularProdcut')->name('popular.product');
Route::get('/feature-product', 'HomeController@FeatureProdcut')->name('feature.product');
Route::get('/tranding-product', 'HomeController@TrandingProdcut')->name('tranding.product');
Route::get('all-services', 'HomeController@OurServices')->name('our.services');
Route::get('our-services-details/{slug}', 'HomeController@servicesDetails')->name('services.details');

Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/blog/{slug}', 'HomeController@blog_details')->name('blog_details');
Route::get('/policy/{slug}', 'HomeController@policy')->name('policy');
Route::get('/getproduct/price', 'HomeController@Price')->name('price');

Route::get('/category/{slug}', 'ViewController@category')->name('category');

Route::get('/gift', 'GiftController@gift')->name('gift');
Route::post('/gift-store', 'GiftController@gift_store')->name('gift_store');

// for search
Route::get('/filter', 'SearchController@filter')->name('filter');

Route::get('/search', 'SearchController@search')->name('search');

Route::post('/ajax_search_to_product', 'SearchController@ajax_search_to_product')->name('ajax_search_to_product');

// for product show
Route::get('/product/{slug}', 'ViewController@product_details')->name('product_details');

// for cart
Route::get('/cart', 'CartController@cart')->name('cart');
Route::get('/add-to-cart/{product_id}', 'CartController@add_to_cart')->name('add_to_cart');
Route::post('/add_to_cart_with_size_color', 'CartController@add_to_cart_with_size_color')->name('add_to_cart_with_size_color');
Route::post('/add_to_cart_with_quentity', 'CartController@add_to_cart_with_quentity')->name('add_to_cart_with_quentity');

// for cart ajax
Route::patch('update-cart', 'CartController@update')->name('update_cart');
Route::delete('remove-from-cart', 'CartController@remove')->name('remove_from_cart');

// SSLCOMMERZ Start
Route::post('/pay', 'SslCommerzPaymentController@pay')->name('pay');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END

Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // for gift
    Route::resource('category', 'CategoryController');
    Route::get('/category-search', 'CategoryController@category_search')->name('category_search');

    // for unit
    Route::resource('unit', 'UnitController');
    Route::resource('services', 'ServicesController');
    Route::get('active/{id}', 'ServicesController@Active')->name('services.active');
    Route::get('inactive/{id}', 'ServicesController@InActive')->name('services.inactive');
    Route::resource('size', 'SizeController');
    Route::resource('colour', 'ColourController');
    Route::resource('brand', 'BrandController');
    Route::resource('division', 'DivisionController');
    Route::resource('district', 'DistrictController');
    Route::resource('payment', 'PaymentController');
    
    Route::get('payment/active/{id}', 'PaymentController@paymentActive')->name('payment.active');
    Route::get('payment/inactive/{id}', 'PaymentController@paymentInActive')->name('payment.inactive');

    // for product
    Route::resource('product', 'ProductController');
    Route::get('/product-search', 'ProductController@product_search')->name('product_search');

    // for order management
    Route::get('/all-orders', 'OrderController@all_order')->name('all_order');
    Route::get('/pending-orders', 'OrderController@pending_order')->name('pending_order');
    Route::get('/confirmed-orders', 'OrderController@confirmed_order')->name('confirmed_order');
    Route::get('/processing-orders', 'OrderController@processing_order')->name('processing_order');
    Route::get('/delivered-orders', 'OrderController@delivered_order')->name('delivered_order');
    Route::get('/successed-orders', 'OrderController@successed_order')->name('successed_order');
    Route::get('/canceled-orders', 'OrderController@canceled_order')->name('canceled_order');

    Route::get('/order-details/{order_id}', 'OrderController@order_view')->name('order_view');
    Route::post('/order_status_change', 'OrderController@order_status_change')->name('order_status_change');

    // for stock report
    Route::resource('purchase', 'PurchaseController');
    Route::get('/purchase-search', 'PurchaseController@purchase_search')->name('purchase_search');
    Route::get('/sold-out', 'StockController@sold_out')->name('sold_out');
    Route::get('/sold-out-search', 'StockController@sold_search')->name('sold_search');
    Route::get('/stock-report', 'StockController@stock_report')->name('stock_report');
    Route::get('/stock-report-search', 'StockController@stock_search')->name('stock_search');

    // for slider/banner
    Route::resource('slider', 'SliderController');
    Route::resource('policy', 'PolicyController');

    // for website setting
    Route::resource('website', 'WebsiteController');

    // for contact message
    Route::resource('message', 'MessageController');
    Route::resource('blog', 'BlogController');

    // for settings
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    // for ajax load
    Route::post('/product_code_ajax_book', 'AjaxController@product_code_ajax_book')->name('product_code_ajax_book');
});

Route::group(['as' => 'customer.', 'prefix' => 'customer', 'namespace' => 'Customer'], function () {
    Route::post('/check','CheckoutController@check')->name('check');
    Route::resource('checkout', 'CheckoutController');
    Route::post('/review', 'WishlistController@review')->name('review');
});

Route::group(['as' => 'customer.', 'prefix' => 'customer', 'namespace' => 'Customer', 'middleware' => ['auth', 'customer']], function () {
    Route::get('/information', 'InformationController@information')->name('dashboard');
    Route::put('profile-update', 'InformationController@updateProfile')->name('profile.update');
    Route::put('password-update', 'InformationController@updatePassword')->name('password.update');
    // for checkout
    Route::resource('wishlist', 'WishlistController');
    Route::get('/my-order', 'CheckoutController@my_order')->name('my_order');
    Route::get('/order-cancel/{order_id}', 'CheckoutController@order_cancel')->name('order_cancel');
    Route::get('/order-success/{order_id}', 'CheckoutController@order_success')->name('order_success');
    Route::get('/order-details/{order_id}', 'CheckoutController@order_view')->name('order_view');
});
Route::get('/cart-login', 'CartLoginController@index');
Route::get('/cart-register', 'CartLoginController@register');