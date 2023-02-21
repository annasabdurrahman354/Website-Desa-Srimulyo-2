<div class="h-full w-full flex flex-col">
    <div id="results" class="w-full h-fit p-3 border-2 border-dashed border-spacing-1 rounded-md bg-white">
        <p>Peramban Anda tidak bisa menampilkan berkas. <a class="text-blue-700 hover:text-blue-500 hover:underline" href="{{$attributes['pdf-file'] ?? null}}"> Klik disini untuk mengunduh! </a></p>
    </div>

    <div id="pdf" class="w-full h-full border border-gray-500"></div>
</div>

@push('scripts')
    <script src="https://unpkg.com/pdfobject@2.2.8/pdfobject.min.js"></script>
    <script>
        var options = {
            pdfOpenParams: {
                navpanes: 0,
                toolbar: 0,
                statusbar: 0,
                view: "FitV",
                pagemode: "thumbs",
            },
            forcePDFJS: true,
            PDFJS_URL: "{{ asset('pdfjs/web/viewer.html') }}"
        };

        var myPDF = PDFObject.embed("{{$attributes['pdf-file'] ?? null}}", "#pdf", options);

        var el = document.querySelector("#results");
        el.setAttribute("class", (myPDF) ? "hidden" : "");

        var el = document.querySelector("#pdf");
        el.setAttribute("class", (myPDF) ? "" : "hidden");
    </script>
@endpush