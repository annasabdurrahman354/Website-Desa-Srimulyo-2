<section class="my-8">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <a href="#" class="hidden items-center mb-4 text-2xl font-semibold text-gray-900 dark:text-white">
            Sistem Informasi Desa Srimulyo   
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="w-full text-center text-xl font-bold leading-tight tracking-tight text-blue-700 md:text-2xl dark:text-white">
                  Daftarkan Akun Baru
                </h1>
                <div>
                    <div class="relative w-full mb-4">
                        <label for="user.name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Nama Anda</label>
                        <input wire:model.lazy="user.name" type="text" class="{{ !$errors->has('user.name') ? 'input-text' : 'input-text-error' }}" placeholder="Nama" required autofocus autocomplete="name"/>
                        @error('user.name')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="user.nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Nomor Induk Kependudukan</label>
                        <input wire:model.lazy="user.nik" type="text" class="{{ !$errors->has('user.nik') ? 'input-text' : 'input-text-error' }}" placeholder="Nomor Induk Kependudukan" required/>
                        @error('user.nik')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="user.nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Nomor Telepon</label>
                        <input wire:model.lazy="user.nomor_telepon" type="text" class="{{ !$errors->has('user.nomor_telepon') ? 'input-text' : 'input-text-error' }}" placeholder="Nomor Telepon" required/>
                        @error('user.nomor_telepon')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="user.email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Email</label>
                        <input wire:model.lazy="user.email" type="email" class="{{ !$errors->has('user.email') ? 'input-text' : 'input-text-error' }}" placeholder="nama@organisasi.com" required autocomplete="email"/>
                        @error('user.email')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="user.jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Jenis Kelamin</label>
                        <div class="flex items-center">
                            @foreach($this->listsForFields['jenis_kelamin'] as $key => $value)
                                <input type="radio" class="input-radio" name="jenis_kelamin" wire:model.lazy="user.jenis_kelamin" value="{{ $key }}"/>
                                <label class="ml-1 mr-4 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $value }}</label>
                            @endforeach
                        </div>
                        @error('user.jenis_kelamin')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="user.tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Tempat Lahir</label>
                        <div class="flex items-stretch">
                                <div class="flex-1">
                                    <select id="provinsi" name="provinsi" wire:model="provinsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Pilih provinsi</option>
                                        @foreach($semuaProvinsi as $prov)
                                            <option class="text-gray-700" value="{{ $prov->id }}">{{ $prov->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if ($provinsi != null)
                                    <div class="flex-1">
                                        <select id="kota" name="kota" wire:model="kota"  class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="" selected>Pilih Kota/Kabupaten</option>
                                             @foreach($semuaKota as $kota)
                                                <option class="text-gray-700" value="{{ $kota->id }}">{{ $kota->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                        </div>
                        @error('user.tempat_lahir')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Tanggal Lahir</label>
                        <x-user-date-picker class="form-control" required wire:model="user.tanggal_lahir" id="tanggal_lahir" name="tanggal_lahir"  picker="date" />
                        @error('user.tanggal_lahir')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="user.alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Alamat</label>
                        <input wire:model.lazy="user.alamat" id="alamat" name="alamat" class="{{ !$errors->has('user.alamat') ? 'input-text' : 'input-text-error' }}" placeholder="Masukkan alamat lengkap" required/>
                        @error('user.alamat')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Password</label>
                        <input wire:model.lazy="password" type="password" name="password" id="password" placeholder="••••••••" class="{{ !$errors->has('password') ? 'input-text' : 'input-text-error' }}" required>
                         @error('password')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="konfirmasi_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Konfirmasi Password</label>
                        <input wire:model.lazy="konfirmasi_password" type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="••••••••" class="{{ !$errors->has('konfirmasi_password') ? 'input-text' : 'input-text-error' }}" required>
                        @error('konfirmasi_password')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <div wire:loading.remove class="flex flex-col justify-center items-center align-middle text-center space-y-2 mt-6">
                            <button type="button" wire:click="submit" class="button-normal w-full rounded-md mb-4">Buat Akun</button>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 ">
                                Sudah pernah mendaftar? <a href="{{route('login')}}" class="font-medium text-blue-700 hover:underline dark:text-blue-500">Masuk disini</a>
                            </p>
                        </div>
                        <div wire:loading>
                            <x-loading/>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        select option {
            font-weight: normal;
            display: block;
            white-space: nowrap;
            min-height: 1.2em;
            padding: 0px 2px 1px;
            color: black;
        }
    </style>
@endpush
