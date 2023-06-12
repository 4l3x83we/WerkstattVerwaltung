<div wire:ignore x-data x-init="() => {
         FilePond.setOptions({
             allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
             server: {
                 process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                     @this.upload('image', file, load, error, progress)
                 },
                 revert:(filename, load) => {
                     @this.removeUpload('image', filename, load)
                 }
             },
         });

         const pond = FilePond.create($refs.input, {
             acceptedFileTypes: ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'],
             allowImagePreview: true,
             imagePreviewMaxHeight: 256,
             allowFileTypeValidation: true,
             allowFileSizeValidation: true,
             maxFileSize: '10MB'
         });

         this.addEventListener('pondReset', e => {
             pond.removeFile();
         });
     }">
    <input type="file" x-ref="input" credits="false">
    @error($id ?? '')
    <span class="text-xs text-red-600 dark:text-red-500">
            {{ $message }}
        </span>
    @enderror
</div>
