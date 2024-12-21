<x-app-layout>
    <div x-data="{
            flashMessage: '{{ \Illuminate\Support\Facades\Session::get('flash_message') }}',
            init() {
                if (this.flashMessage) {
                    setTimeout(() => this.$dispatch('notify', { message: this.flashMessage }), 200)
                }
            }
        }" class="container mx-auto lg:w-2/3 p-5">
        @if (session('error'))
            <div class="py-2 px-3 bg-error text-white mb-2 rounded-full">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold my-4">Pengaturan Profil</h1>

        <div class="bg-white rounded-lg p-3 overflow-x-auto">
            <div class="p-6 rounded-lg md:col-span-2 w-full">
                <form action="{{ route('profile.update') }}" method="post">
                    @csrf
                    <h2 class="text-xl font-semibold mb-4">Detail Profil</h2>

                    <div class="grid gap-4">
                        <div class="flex col-span-1 gap-2">
                            <label class="flex col-span-1 items-center gap-4">
                                <span class="w-32 text-right">Nama depan:</span>
                                <x-input type="text" name="name" value="{{ old('name', $customer->name) }}"
                                    placeholder="Nama" class="border border-gray-300 rounded-lg w-full px-3 py-2" />
                            </label>
                            <label class="flex items-center gap-4">
                                <span class="w-32 text-right">Nama belakang:</span>
                                <x-input type="text" name="name" value="{{ old('name', $customer->name) }}"
                                    placeholder="Nama" class="border border-gray-300 rounded-lg w-full px-3 py-2" />
                            </label>
                        </div>

                        <label class="flex items-center gap-4">
                            <span class="w-32 text-right">Email:</span>
                            <x-input type="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="name@mail.com"
                                class="border border-gray-300 rounded-lg w-full px-3 py-2" />
                        </label>
                        <label class="flex items-center gap-4">
                            <span class="w-32 text-right">No Telp:</span>
                            <x-input type="number" name="phone" value="{{ old('phone', $customer->phone) }}"
                                placeholder="+62" class="border border-gray-300 rounded-lg w-full px-3 py-2" />
                        </label>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-xl font-semibold mb-4">Alamat Pengiriman</h2>
                        <textarea name="address"
                            class="textarea border border-gray-300 rounded-lg w-full min-h-[100px] p-2"
                            placeholder="Alamat Lengkap"
                            value="{{ old('address', $address) }}"> {{ old('address', $address) }}</textarea>
                    </div>

                    <x-button class="w-full mt-5">
                        Update
                    </x-button>
                    <button id="pay-button" class="btn btn-outline">Bayar dengan Midtrans</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>