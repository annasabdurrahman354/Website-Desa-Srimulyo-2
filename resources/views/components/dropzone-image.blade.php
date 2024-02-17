<div wire:ignore>
   <div class="dropzone" {{ $attributes }}></div>
</div>

@push('scripts')
    <script>
    Dropzone.options[_.camelCase("{{ $attributes['id'] }}")] = {
        url: "{{ $attributes['action'] }}",
        maxFilesize: {{$attributes['max-file-size'] ?? 5}},
        maxFiles: {{$attributes['max-files'] ?? 'null'}},
        addRemoveLinks: true,
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        acceptedFiles: ".jpeg, .jpg, .png",
        params: {
            @if($attributes['max-width'])
            max_width: {{$attributes['max-width']}},
            @endif
            @if($attributes['max-height'])
            max_height: {{$attributes['max-height']}},
            @endif
            model_id: {{$attributes['model-id'] ?? 0}},
            collection_name: "{{ $attributes['collection-name'] ?? 'default' }}"
        },
        transformFile: function(file, done) {
            // Create Dropzone reference for use in confirm button click handler
            var myDropZone = this;
            // Create the image editor overlay
            var editor = document.createElement('div');
            editor.style.position = 'fixed';
            editor.style.left = 0;
            editor.style.right = 0;
            editor.style.top = 0;
            editor.style.bottom = 0;
            editor.style.zIndex = 99999;
            editor.style.backgroundColor = '#000';
            document.body.appendChild(editor);
            // Create confirm button at the top left of the viewport
            var buttonConfirm = document.createElement('button');
            buttonConfirm.style.position = 'absolute';
            buttonConfirm.style.left = '10px';
            buttonConfirm.style.top = '10px';
            buttonConfirm.style.zIndex = 999999;
            buttonConfirm.textContent = 'Confirm';
            
            var image = new Image();
            // Read the file content as a data URL and assign it to the Image object
            var reader = new FileReader();
            reader.onload = function(event) {
                image.src = event.target.result;
                editor.appendChild(image);
                // Create Cropper.js
                var cropper = new Cropper(image, {
                    aspectRatio: {{$attributes['ratio'] ?? null}}
                });

                editor.appendChild(buttonConfirm);
                buttonConfirm.addEventListener('click', function() {
                    // Get the canvas with image data from Cropper.js
                    var canvas = cropper.getCroppedCanvas({
                        minWidth: 128,
                        minHeight: 128,
                        maxWidth: 4096,
                        maxHeight: 4096,
                        fillColor: '#fff',
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                    });
                    var dataUrl = canvas.toDataURL(file.type);
                    var blob = dataURLtoBlob(dataUrl);
                    // Turn the canvas into a Blob (file object without a name)
                    var dataUrl = canvas.toDataURL(file.type);
                    // Convert the data URL to a Blob
                    var blob = dataURLtoBlob(dataUrl);
                    // Create a new Dropzone file thumbnail
                    myDropZone.createThumbnail(
                        blob,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        false,
                        function(dataURL) {
                            // Update the Dropzone file thumbnail
                            myDropZone.emit('thumbnail', file, dataURL);
                            // Return the file to Dropzone
                            done(blob);
                        });
                    // Remove the editor from the view
                    document.body.removeChild(editor);
                });
            };
            reader.readAsDataURL(file);
        },
        success: function(file, response) {
            @this.addMedia(response.media)
        },
        removedfile: function(file) {
            file.previewElement.remove()

            if (file.status === 'error') {
                return;
            }

            if (file.xhr) {
                var response = JSON.parse(file.xhr.response)
                @this.removeMedia(response.media)
            } else {
                @this.removeMedia(file)

                if (this.options.maxFiles !== null) {
                    this.options.maxFiles++
                }
            }
        },
        init: function() {
            document.addEventListener("livewire:load", () => {
                let files = @this.mediaCollections["{{ $attributes['collection-name'] ?? 'default' }}"]
                if (files !== undefined && files.length) {
                    files.forEach(file => {
                        let fileClone = JSON.parse(JSON.stringify(file))
                        this.files.push(fileClone)
                        
                        this.emit("addedfile", fileClone)
                        
                        if (fileClone.preview_thumbnail !== undefined) {
                            this.emit("thumbnail", fileClone, fileClone.preview_thumbnail)
                        } else {
                            this.emit("thumbnail", fileClone, fileClone.url)
                        }

                        this.emit("complete", fileClone)
                        if (this.options.maxFiles !== null) {
                            this.options.maxFiles--
                        }
                    })
                }
            });
            this.on("addedfile", file => {
            });
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error')
            let message = $.type(response) === 'string' ? response : response.errors.file
            return _.map(file.previewElement.querySelectorAll('[data-dz-errormessage]'), r => r.textContent = message)
        }
    }
    function dataURLtoBlob(dataURL) {
        var parts = dataURL.split(';base64,');
        var contentType = parts[0].split(':')[1];
        var raw = window.atob(parts[1]);
        var rawLength = raw.length;
        var uInt8Array = new Uint8Array(rawLength);
        for (var i = 0; i < rawLength; ++i) {
            uInt8Array[i] = raw.charCodeAt(i);
        }
        return new Blob([uInt8Array], {type: contentType});
    }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
@endpush

@push('styles')
    @once
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
    @endonce
@endpush