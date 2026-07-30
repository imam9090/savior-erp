<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Attendance\ClockInOut;
use App\Livewire\Attendance\AttendanceHistory;
use App\Livewire\Attendance\AttendanceAdmin;
use App\Livewire\Invoicing\InvoiceList;
use App\Livewire\Invoicing\InvoiceForm;
use App\Http\Controllers\InvoicePdfController;
use App\Livewire\Discussion\ForumList;
use App\Livewire\Discussion\ThreadView;
use App\Livewire\Messaging\Inbox;
use App\Livewire\Messaging\Conversation;
use App\Livewire\Project\ProjectList;
use App\Livewire\User\UserList;
use App\Livewire\User\UserForm;
use App\Livewire\Dashboard\Overview;
use App\Livewire\Product\ProductList;
use App\Livewire\Product\ProductForm;
use App\Livewire\Project\ProjectForm;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Overview::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/attendance', ClockInOut::class)->name('attendance');
    Route::get('/attendance/history', AttendanceHistory::class)->name('attendance.history');

    Route::middleware('role:superadmin')->group(function () {
        Route::get('/attendance/admin', AttendanceAdmin::class)->name('attendance.admin');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/invoices', InvoiceList::class)->name('invoices.index');
    Route::get('/invoices/{invoice}/pdf', InvoicePdfController::class)->name('invoices.pdf');

    Route::middleware('role:superadmin,admin_finance')->group(function () {
        Route::get('/invoices/create', InvoiceForm::class)->name('invoices.create');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/projects/{project}/discussions', ForumList::class)->name('forum.show');
    Route::get('/discussions/{discussion}', ThreadView::class)->name('discussion.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/messages', Inbox::class)->name('messages.inbox');
    Route::get('/messages/{contact}', Conversation::class)->name('messages.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/projects', ProjectList::class)->name('projects.index');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/users', UserList::class)->name('users.index');
    Route::get('/users/create', UserForm::class)->name('users.create');
});

Route::middleware(['auth', 'role:superadmin,admin_finance'])->group(function () {
    Route::get('/products', ProductList::class)->name('products.index');
    Route::get('/products/create', ProductForm::class)->name('products.create');
});

Route::middleware(['auth', 'role:superadmin,admin_client'])->group(function () {
    Route::get('/projects/create', ProjectForm::class)->name('projects.create');
});


require __DIR__.'/auth.php';