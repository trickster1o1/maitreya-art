<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\PayPalPaymentController;
use Illuminate\Support\Facades\Route;
use App\Mail\ItemBoughtMail;
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


Auth::routes();

Route::get('/email', function () {
    Mail::to('email@mail.com')->send(new ItemBoughtMail());
    return new ItemBoughtMail();
});

Route::get('/web', [App\Http\Controllers\PageController::class, 'index']);


Route::get('/adminpannel', [App\Http\Controllers\AdminController::class, 'index']);
Route::get('/remove/user/{user}', [App\Http\Controllers\AdminController::class, 'rmvUser']);
Route::get('/remove/{product}', [App\Http\Controllers\AdminController::class, 'remove']);
Route::get('/update/{product}', [App\Http\Controllers\AdminController::class, 'update']);

Route::get('/', [App\Http\Controllers\FrontController::class, 'index']);


// php or laravel code test route............................................................

Route::get('/check', function () {
    $category = [
        [
            'title' => 'catA',
            'children' => [
                [
                    'title' => 'catA.2',
                    'product' => [
                        [
                            'title' => 'prodA'
                        ], [
                            'title' => 'prodB'
                        ]
                    ]
                ]
            ]
        ],
        [
            'title' => 'catB',
            'children' => [
                [

                    'title' => 'catB.2',
                    'product' => []
                ],
                [
                    'title' => 'catB.3',
                    'product' => [
                        ['title' => 'prodB.3.a']
                    ]
                ]
            ]
        ],
        [
            'title' => 'catC',
            'children' => [
                [

                    'title' => 'catC.2',
                    'children'=>[
                        [
                            'title'=>'cc',
                            'product'=> []
                        ]
                    ]
                ],
                [
                    'title' => 'catC.3',
                    'product' => []
                ]
            ]
        ]
    ];

    // dd($category[0]['children']);
    function categoryChecker($catt)
    {
        if (isset($catt['children']) && count($catt['children'])) {
            foreach ($catt['children'] as $children) {
                $chk = categoryChecker($children);
                if($chk == 1) {
                    return 1;
                }
            }
        } else {
            if(isset($catt['product']) && count($catt['product'])) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    $flag = 0;
    foreach ($category as $cat) {
        $p = categoryChecker($cat);
        if($p == 1) {
            echo '<div  style="border: 1px solid black; padding: 15px;margin-bottom:1em;">';
            echo '<h1>'.$cat['title'].'</h1>';
            if(isset($cat['children']) && count($cat['children'])) {
                foreach ($cat['children'] as $ct) {
                    $f= categoryChecker($ct);
                    if($f == 1) {
                        echo '<h2 style="color: blue;">'.$ct['title'].'</h2>';
                        if(isset($ct['children']) && count($ct['children'])) {
                            foreach ($ct['children'] as $cc) {
                                $f= categoryChecker($cc);
                                if($f == 1) {
                                    echo '<h3 style="color: blue;">'.$cc['title'].'</h3>';
                                }
                            }
                        } else {
                            if(isset($ct['product'])) {
                                foreach ($ct['product'] as $prod) {
                                    echo '<span>'.$prod['title'].'...</span>';
                                }
                            }
                        }













                    }
                }
            } else {
                if(isset($cat['product'])) {
                    foreach ($cat['product'] as $prod) {
                        echo '<span style="color: yellow;">'.$prod['title'].'...</span>';
                    }
                }
            }
            echo "</div>";
        }
    }


    
});


// ..................................................................................................


Route::get('/home', [App\Http\Controllers\FrontController::class, 'index'])->name('home');
Route::get('/sucess', [App\Http\Controllers\FrontController::class, 'sucess']);
Route::get('/failed', [App\Http\Controllers\FrontController::class, 'failed']);
Route::get('/search', [App\Http\Controllers\FrontController::class, 'search']);
Route::get('/settings/{user}', [App\Http\Controllers\FrontController::class, 'setting']);
Route::patch('/userUpdate/{user}', [App\Http\Controllers\FrontController::class, 'userUpdate']);

Route::get('/p/create', [App\Http\Controllers\PostController::class, 'create']);
Route::post('/p', [App\Http\Controllers\PostController::class, 'store']);
Route::patch('/p/{product}', [App\Http\Controllers\AdminController::class, 'edit']);
Route::get('/cmnt/{product}', [App\Http\Controllers\PostController::class, 'postCmnt']);
Route::get('/deactivate/{user}', [App\Http\Controllers\PostController::class, 'deactivate']);


Route::get('/cart', [App\Http\Controllers\CartController::class, 'index']);
Route::get('/cart/cancel', [App\Http\Controllers\CartController::class, 'cancelCart']);
Route::get('/cart/add/{item}', [App\Http\Controllers\CartController::class, 'addItem']);
Route::get('/cart/remove/{item}', [App\Http\Controllers\CartController::class, 'removeItem']);


Route::get('/handle-payment', [App\Http\Controllers\PayPalPaymentController::class, 'handlePayment'])->name('make.payment');

Route::get('cancel-payment', 'PayPalPaymentController@paymentCancel')->name('cancel.payment');

Route::get('payment-success', 'PayPalPaymentController@paymentSuccess')->name('success.payment');

Route::get('/sendbasicemail', [App\Http\Controllers\MailController::class, 'basic_email'])->name('mail.basic_email');

// Route::get('sendbasicemail','MailController@basic_email');
// Route::get('sendhtmlemail','MailController@html_email');
// Route::get('sendattachmentemail','MailController@attachment_email');