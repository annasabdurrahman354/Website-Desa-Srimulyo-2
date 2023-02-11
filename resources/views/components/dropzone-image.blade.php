<div wire:ignore>
   <div class="dropzone" {{ $attributes }}>
</div>
</div>
@push('scripts')
    <script>
    Dropzone.options[_.camelCase("{{ $attributes['id'] }}")] = {
        url: "{{ $attributes['action'] }}",
        maxFilesize: {{ $attributes['max-file-size'] ?? 2 }},
        maxFiles: {{ $attributes['max-files'] ?? 'null' }},
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        @if($attributes['max-width'])
        max_width: {{ $attributes['max-width'] }},
        @endif
        @if($attributes['max-height'])
        max_height: {{ $attributes['max-height'] }},
        @endif
        size: {{ $attributes['max-file-size'] ?? 2 }},
        model_id: {{ $attributes['model-id'] ?? 0 }},
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
            editor.style.zIndex = 9999;
            editor.style.backgroundColor = '#000';
            document.body.appendChild(editor);
            // Create confirm button at the top left of the viewport
            var buttonConfirm = document.createElement('button');
            buttonConfirm.style.position = 'absolute';
            buttonConfirm.style.left = '10px';
            buttonConfirm.style.top = '10px';
            buttonConfirm.style.zIndex = 9999;
            buttonConfirm.textContent = 'Confirm';
            editor.appendChild(buttonConfirm);
            buttonConfirm.addEventListener('click', function() {
                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                width: 256,
                height: 256
                });
                // Turn the canvas into a Blob (file object without a name)
                canvas.toBlob(function(blob) {
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
                });
                // Remove the editor from the view
                document.body.removeChild(editor);
            });
            // Create an image node for Cropper.js
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);
            
            // Create Cropper.js
            var cropper = new Cropper(image, { aspectRatio: 1/3 });
        },
        success: function (file, response) {
        @this.addMedia(response.media)
        },
        removedfile: function (file) {
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
        init: function () {
        document.addEventListener("livewire:load", () => {
            let files = @this.mediaCollections["{{ $attributes['collection-name'] ?? 'default' }}"]
            if (files !== undefined && files.length) {
                files.forEach(file => {
                    let fileClone = JSON.parse(JSON.stringify(file))
                    this.files.push(fileClone)
                    this.emit("transformFile", fileclone)
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
        },
        error: function (file, response) {
        file.previewElement.classList.add('dz-error')
        let message = $.type(response) === 'string' ? response : response.errors.file
        return _.map(file.previewElement.querySelectorAll('[data-dz-errormessage]'), r => r.textContent = message)
        }
    }
    </script>
    <script src="https://unpkg.com/cropperjs"></script>

@endpush

@push('styles')
    @once
        <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
    @endonce
@endpush