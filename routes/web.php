<?php

use App\Http\Controllers\ProfileController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCustomizationController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminOrderItemController;
use App\Http\Controllers\Admin\AdminWishlistController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PageController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Admin\GiftCardController;

Route::get('/', function () {
    return view('pages.index');
});
Route::middleware('auth')->group(function () {
Route::get('/customizer', function () {
    return view('pages.customizer');
})->name('customizer');});
Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/certificate', function () {
    return view('pages.certificate');
});
Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/gift-card', function () {
    return view('pages.gift-card');
});





////////////////////////////////////////////////






    // Non-admin routes
    Route::resource('/users', UserController::class);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('pages.profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('pages.profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('pages.profile.update');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('customizations', AdminCustomizationController::class);
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::resource('products', AdminProductController::class);
        Route::resource('wishlist', AdminWishlistController::class)->except(['show']);
        Route::resource('orders', AdminOrderController::class)->except(['show']);
        Route::resource('gift_cards', GiftCardController::class);
        Route::resource('certificates', CertificateController::class);
    });
    
  


    Route::prefix('admin/order-items')->name('admin.order_items.')->group(function () {
        Route::get('/', [AdminOrderItemController::class, 'index'])->name('index');
        Route::get('/create', [AdminOrderItemController::class, 'create'])->name('create');
        Route::post('/', [AdminOrderItemController::class, 'store'])->name('store');
        Route::get('/{order_item}/edit', [AdminOrderItemController::class, 'edit'])->name('edit');
        Route::put('/{order_item}', [AdminOrderItemController::class, 'update'])->name('update');
        Route::delete('/{order_item}', [AdminOrderItemController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/admin_roles')->name('admin.admin_roles.')->group(function () {
        Route::get('/', [AdminRoleController::class, 'index'])->name('index');
        Route::get('/create', [AdminRoleController::class, 'create'])->name('create');
        Route::post('/', [AdminRoleController::class, 'store'])->name('store');
        Route::get('/{admin_role}/edit', [AdminRoleController::class, 'edit'])->name('edit');
        Route::put('/{admin_role}', [AdminRoleController::class, 'update'])->name('update');
        Route::delete('/{admin_role}', [AdminRoleController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/messages')->name('admin.messages.')->group(function () {
        Route::get('/', [AdminMessageController::class, 'index'])->name('index');
        Route::get('/create', [AdminMessageController::class, 'create'])->name('create');
        Route::post('/', [AdminMessageController::class, 'store'])->name('store');
        Route::get('/{message}/edit', [AdminMessageController::class, 'edit'])->name('edit');
        Route::put('/{message}', [AdminMessageController::class, 'update'])->name('update');
        Route::delete('/{message}', [AdminMessageController::class, 'destroy'])->name('destroy');
    });

});



//////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////

// Route::post('/add-to-cart', [ProductController::class, 'addToCart'])->name('add_to_cart');
// Route::get('/record-voice', [ProductController::class, 'showVoiceRecord'])->name('record_voice');
// use App\Http\Controllers\CustomizationController;

// // Other routes...
use App\Http\Controllers\CustomizationController;
Route::middleware('auth')->group(function () {
Route::get('/customize-bear', function () {
    return view('customizer'); // replace with your Blade filename
})->name('bear.customize');});
Route::get('/shop', function () {
    return view('pages.shop'); // replace with your Blade filename
})->name('shop');
Route::middleware('auth')->group(function () {
Route::get('/fav', function () {
    return view('pages.wishlist'); // replace with your Blade filename
})->name('fav');

Route::post('/customization', [CustomizationController::class, 'store'])->name('customization.store');});
use App\Http\Controllers\ContactController;

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');use App\Http\Controllers\MessageController;

Route::post('/messages', [ContactController::class, 'store'])->name('messages.store');








////////////////////////////////////////////////////////
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');




// Voice recording storage endpoint
// Define the voice recording route - using an absolute path

// Alternative route matching what your current JavaScript is using
use App\Http\Controllers\VoiceRecordingController;
Route::middleware('auth')->group(function () {
Route::get('/pages/voice_recording', function() {
    return view('pages.voice_recording');
})->name('pages.voice_recording');

Route::post('/pages/voice_recording/store', [VoiceRecordingController::class, 'store'])
    ->name('pages.voice_recording.store');

});


Route::post('/gift-cards', [GiftCardController::class, 'store'])->name('pages.gift-cards.store');




///////////////////////////////////////////////////////////////////////////

Route::middleware('auth')->group(function () {
Route::get('/checkout', [CheckoutController::class, 'index'])->name('pages.checkout.index');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('pages.checkout.placeOrder');
///////////////////////////////////////////////////////////////////////////


Route::get('/certificate', [App\Http\Controllers\CertificateController::class, 'index'])->name('pages.certificate');
Route::post('/certificate/generate', [App\Http\Controllers\CertificateController::class, 'generate'])->name('pages.certificate.generate');
Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{product}', [App\Http\Controllers\WishlistController::class, 'add'])->name('wishlist.add');


    // Dashboard Route



    Route::get('/customize/{product}', [PageController::class, 'customizer'])->name('pages.customizer');

    Route::post('/customizations/store', [\App\Http\Controllers\CustomizationController::class, 'store'])->name('pages.customizer.store');
     });
        Route::get('/dashboard', function () {
            return view('dashboard');
        });
    
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        });
    

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('pages.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('pages.orders.show');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/my-bear-messages', [VoiceRecordingController::class, 'index'])
        ->name('voice.messages.index');
});
Route::middleware('auth')->group(function () {
Route::get('/products/{product}', [ProductController::class, 'show'])->name('pages.products.show');



Route::get('/order/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/order', [OrderController::class, 'store'])->name('orders.store');

Route::get('/orderInfo', [OrderItemController::class, 'showInfoForm'])->name('orders.info');
Route::post('/order-items', [OrderItemController::class, 'store'])->name('order-items.store');
Route::get('/order-summary/{orderId}', [OrderController::class, 'summary'])->name('order-summary');



Route::get('/order/{order}/checkout', [OrderController::class, 'checkout'])->name('order.checkout');



// Show the info form after items are added
Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');

// Show form to enter order information (email, address, phone, etc.)
Route::get('/order/{order}/info', [OrderController::class, 'showInfoForm'])->name('orders.info');

// Store submitted order information
Route::post('/order/{order}/info', [OrderController::class, 'storeInfo'])->name('order.storeInfo');

// Show order summary
Route::get('/order/{order}/summary', [OrderController::class, 'showSummary'])->name('order.showSummary');

// Show checkout page
Route::get('/order/{order}/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

/////////////////////////////////////
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/orders/create', [OrderController::class, 'createFromCart'])->name('orders.create');
Route::get('/cart', function () {
    return view('cart.index');
})->name('cart.index');});
use App\Http\Controllers\CartController;
Route::middleware('auth')->group(function () {
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->middleware('auth')->name('cart.checkout');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');


Route::get('/checkout', [CartController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout', [CartController::class, 'placeOrder'])->name('checkout.submit');
Route::get('/cart/confirmation/{order}', function (\App\Models\Order $order) {
    return view('cart.confirmation', compact('order'));
})->name('cart.confirmation');});
/////////////////////////////////////////////////////
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\WishlistController;

Route::middleware(['auth'])->group(function () {
    Route::post('/wishlist/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});
// use App\Http\Controllers\BearCertificateController;

// // Public route for viewing shared certificates
// Route::get('/certificate/view/{certificateNumber}', [BearCertificateController::class, 'view'])
//      ->name('pages.certificate.view');

// // Protected routes (require authentication)
// Route::middleware(['auth', 'verified'])->group(function () {
    
//     // Main certificate routes
//     Route::prefix('certificate')->name('pages.certificate.')->group(function () {
//         Route::get('/', [BearCertificateController::class, 'index'])->name('index');
//         Route::post('/generate', [BearCertificateController::class, 'generate'])->name('generate');
//         Route::get('/edit/{certificate}', [BearCertificateController::class, 'edit'])->name('edit');
//         Route::put('/update/{certificate}', [BearCertificateController::class, 'update'])->name('update');
//         Route::patch('/deactivate/{certificate}', [BearCertificateController::class, 'deactivate'])->name('deactivate');
//         Route::patch('/reactivate/{certificate}', [BearCertificateController::class, 'reactivate'])->name('reactivate');
//         Route::get('/download/{certificate}', [BearCertificateController::class, 'download'])->name('download');
//         Route::get('/share-url/{certificate}', [BearCertificateController::class, 'getShareUrl'])->name('share-url');
//     });
    
//     // User's bear collection
//     Route::get('/my-bears', [BearCertificateController::class, 'myBears'])->name('pages.my-bears');
    
//     // API endpoints
//     Route::get('/api/user/bear-stats', [BearCertificateController::class, 'userStats'])->name('api.user.bear-stats');
// });
Route::middleware('auth')->group(function () {
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');});