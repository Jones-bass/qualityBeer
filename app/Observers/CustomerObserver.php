<?php

namespace App\Observers;

use App\Enums\PanelTypeEnum;
use App\Mail\NewCustomerMail;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerObserver
{
    public function created(Customer $customer): void
    {
        $password = Str::password(8);

        $user = User::create([
            'name' => $customer->name,
            'email' => $customer->email,
            'panel' => PanelTypeEnum::APP,
            'password' => bcrypt($password),
        ]);

        $customer->user_id = $user->id; 

        Mail::to($customer->email)->send(new NewCustomerMail($customer, $password));
    }
}
