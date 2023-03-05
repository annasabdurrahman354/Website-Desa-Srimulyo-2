<div class="relative">
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{route('user.home')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Profil</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="relative">
        <div>

            <div class="relative w-full mb-4">
                <label for="user.name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Nama Anda</label>
                <input wire:model.defer="user.name" type="text" class="{{ !$errors->has('user.name') ? 'input-text' : 'input-text-error' }}" {{$edit ? "" : "disabled"}} placeholder="Nama" required autofocus autocomplete="name"/>
                @error('user.name')
                    <div class="text-red-500">
                        <small>{{ $message }}</small>
                    </div>
                @enderror
            </div>

            <div class="relative w-full mb-4">
                <label for="user.nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Nomor Induk Kependudukan</label>
                <input wire:model.defer="user.nik" type="text" class="{{ !$errors->has('user.nik') ? 'input-text' : 'input-text-error' }}" {{$edit ? "" : "disabled"}} placeholder="Nomor Induk Kependudukan" required/>
                @error('user.nik')
                    <div class="text-red-500">
                        <small>{{ $message }}</small>
                    </div>
                @enderror
            </div>

            <div class="relative w-full mb-4">
                <label for="user.nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Nomor Telepon</label>
                <input wire:model.defer="user.nomor_telepon" type="text" class="{{ !$errors->has('user.nomor_telepon') ? 'input-text' : 'input-text-error' }}" {{$edit ? "" : "disabled"}} placeholder="Nomor Telepon" required/>
                @error('user.nomor_telepon')
                    <div class="text-red-500">
                        <small>{{ $message }}</small>
                    </div>
                @enderror
            </div>

            <div class="relative w-full mb-4">
                <label for="user.email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Email</label>
                <input wire:model.defer="user.email" type="email" class="{{ !$errors->has('user.email') ? 'input-text' : 'input-text-error' }}" {{$edit ? "" : "disabled"}} placeholder="nama@organisasi.com" required autocomplete="email"/>
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
                        <input {{$edit ? "" : "disabled"}} type="radio" class="input-radio" name="jenis_kelamin" wire:model.defer="user.jenis_kelamin" value="{{ $key }}"/>
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
                            <select {{$edit ? "" : "disabled"}} id="provinsi" name="provinsi" wire:model="provinsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected>Pilih provinsi</option>
                                @foreach($semuaProvinsi as $prov)
                                    <option class="text-gray-700" value="{{ $prov->id }}">{{ $prov->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($provinsi != null)
                            <div class="flex-1">
                                <select {{$edit ? "" : "disabled"}} id="kota" name="kota" wire:model="kota"  class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                <div class="{{ $edit ? "visible" : "hidden"}}">
                    <x-user-date-picker class="form-control" required wire:model="user.tanggal_lahir" id="tanggal_lahir" name="tanggal_lahir"  picker="date"/>
                </div>
                @if ( !$edit )
                    <input type="text" wire:ignore class="{{ !$errors->has('user.tanggal_lahir') ? 'input-text' : 'input-text-error' }}" {{$edit ? "" : "disabled"}} placeholder="{{$user->tanggal_lahir}}"/>
                @endif
                @error('user.tanggal_lahir')
                    <div class="text-red-500">
                        <small>{{ $message }}</small>
                    </div>
                @enderror
            </div>

            <div class="relative w-full mb-4">
                <label for="user.alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Alamat</label>
                <input {{$edit ? "" : "disabled"}} wire:model.defer="user.alamat" id="alamat" name="alamat" type="text" class="{{ !$errors->has('user.nomor_telepon') ? 'input-text' : 'input-text-error' }}" placeholder="Masukkan alamat lengkap" required/>
                @error('user.alamat')
                    <div class="text-red-500">
                        <small>{{ $message }}</small>
                    </div>
                @enderror
            </div>

            <div class="border border-blue-200 border-dashed rounded-md p-4">
                <div class="relative w-full mb-4">
                    <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Password Lama</label>
                    <input {{$changePassword ? "" : "disabled"}} wire:model.defer="old_password" type="password" name="old_password" id="old_password" placeholder="••••••••" class="{{ !$errors->has('old_password') ? 'input-text' : 'input-text-error' }}" required>
                    @error('old_password')
                        <div class="text-red-500">
                            <small>{{ $message }}</small>
                        </div>
                    @enderror
                </div>

                @if ($changePassword)
                    <div class="relative w-full mb-4">
                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Password Baru</label>
                        <input {{$changePassword ? "" : "disabled"}} wire:model.defer="new_password" type="password" name="new_password" id="new_password" placeholder="••••••••" class="{{ !$errors->has('new_password') ? 'input-text' : 'input-text-error' }}" required>
                        @error('new_password')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="relative w-full mb-4">
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white required">Konfirmasi Password Baru</label>
                        <input {{$changePassword ? "" : "disabled"}} wire:model.defer="confirm_password" type="password" name="confirm_password" id="confirm_password" placeholder="••••••••" class="{{ !$errors->has('confirm_password') ? 'input-text' : 'input-text-error' }}" required>
                        @error('new_password')
                            <div class="text-red-500">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>
                @endif

                @if ($edit)
                    <button type="button" wire:click="toggleChangePassword" class="button-alternative rounded-md">{{$changePassword ? "Batalkan Ubah Password" : "Ubah Password"}}</button>
                @endif
            </div> 
          
            
            <div>
                <div wire:loading.remove class="flex items-center align-middle text-center mt-6">
                    <button type="button" wire:click="toggleEdit" class="button-normal rounded-md">{{$edit ? "Batal" : "Ubah Profil"}}</button>
                    @if ($edit)
                        <button type="button" wire:click="submit" class="button-green rounded-md">Simpan Profil</button>
                    @endif
                </div>
                <div wire:loading class="mt-6">
                    <x-loading/>
                </div> 
            </div>
        </div>
    </div>
</div>