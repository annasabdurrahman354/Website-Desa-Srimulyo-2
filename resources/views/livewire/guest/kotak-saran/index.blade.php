<section class="py-8 md:py-0 h-full md:h-screen flex items-center text-gray-600 body-font bg-gray-50">
  <div class="container px-5 py-2 my-auto mx-auto flex sm:flex-nowrap flex-wrap ">
    <div class="lg:w-2/3 w-full bg-gray-300 border border-1 border-gray-300 shadow rounded-lg overflow-hidden mb-4 sm:mb-0 sm:mr-10 flex items-end justify-start relative">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4738.7294989904!2d111.08425474334216!3d-7.452743747036421!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a1d5d65a1487b%3A0x5664ca649c8d9ab4!2sKantor%20Desa%20Srimulyo!5e0!3m2!1sen!2sid!4v1676429974431!5m2!1sen!2sid" width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map" marginheight="0" marginwidth="0" scrolling="no" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md mt-72 md:mt-0 w-full">
        <div class="lg:w-1/2 px-6">
          <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">ALAMAT KANTOR</h2>
          <p class="mt-1">Alamate mana tha?</p>
        </div>
        <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
          <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
          <a class="text-blue-500 leading-relaxed">example@email.com</a>
          <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">PHONE</h2>
          <p class="leading-relaxed">123-456-7890</p>
        </div>
      </div>
    </div>
    <div class="lg:w-1/3 bg-white border border-1 border-gray-300 rounded-lg shadow md:flex md:flex-col md:ml-auto w-full px-4 py-4 md:mt-0">
      <h2 class="text-gray-900 text-xl mb-1 font-semibold title-font">Kotak Saran</h2>
      <p class="leading-relaxed mb-5 text-gray-600">Silakan berikan kritik atau saran Anda untuk pembangunan desa yang lebih baik!</p>
      <div class="relative mb-4">
        <label for="name" class="leading-7 text-sm text-gray-600">Nama Anda</label>
        <input wire:model.defer='kotakSaran.pengirim' type="text" id="name" name="name" class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        <div class="validation-message">
            {{ $errors->first('kotakSaran.pengirim') }}
        </div>
      </div>
      <div class="relative mb-4">
        <label for="telepon" class="leading-7 text-sm text-gray-600">Nomor Telepon</label>
        <input wire:model.defer='kotakSaran.nomor_telepon' type="text" pattern="[0-9]+" id="telepon" name="telepon" class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        <div class="validation-message">
            {{ $errors->first('kotakSaran.nomor_telepon') }}
        </div>
      </div>
      <div class="relative mb-4">
        <label for="message" class="leading-7 text-sm text-gray-600 required">Kritik/Saran</label>
        <textarea wire:model.defer='kotakSaran.isi' id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
        <div class="validation-message">
            {{ $errors->first('kotakSaran.isi') }}
        </div>
      </div>
      <button class="button-normal">Kirim</button>
      <p class="text-sm text-gray-500 mt-3">Kosongkan nama dan telepon jika menginginkan anonim.</p>
    </div>
  </div>
</section>
