<?php

namespace App\Http\Controllers;

use App\Enums\AddressType;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Country;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class ProfileController extends Controller
{
    public function view(Request $request)
    {
        /** @var \App\Models\User $user */
        /** @var \App\Models\Customer $customer */
        /** @var \App\Models\CustomerAddress $address */
        $user = $request->user();
        $customer = $user->customer;
        $address = $user->customerAddress;// ?: new CustomerAddress();

        return view('profile.view', compact('customer', 'address', 'user'));
    }
    public function store(ProfileRequest $request)
    {
        // Get validated data as an array
        $customerData = $request->validated();

        /** @var \App\Models\User $user */
        $user = $request->user();

        /** @var \App\Models\Customer $customer */
        $customer = $user->customer;

        DB::beginTransaction();
        try {
            // Update user data
            $user->update([
                'name' => $customerData['name'],
                'email' => $customerData['email'],
                'phone' => $customerData['phone']
            ]);

            // Update or create customer address
            CustomerAddress::updateOrCreate(
                ['user_id' => $user->id],
                ['address' => $customerData['address']]
            );

            DB::commit();

            $request->session()->flash('flash_message', 'Profile was successfully updated.');
            return redirect()->route('profile');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical(__METHOD__ . ' method does not work. ' . $e->getMessage());
            throw $e;
        }
    }

    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $passwordData = $request->validated();

        $user->password = Hash::make($passwordData['new_password']);
        $user->save();

        $request->session()->flash('flash_message', 'Your password was successfully updated.');

        return redirect()->route('profile');
    }
}
