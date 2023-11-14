@push('css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet">
    <style>
        .filepond--item {
            width: calc(50% - 0.5em);
        }

        @media (min-width: 30em) {
            .filepond--item {
                width: calc(33.33% - 0.5em);
            }
        }

        @media (min-width: 50em) {
            .filepond--item {
                width: calc(33.33% - 0.5em);
            }
        }
    </style>
@endpush
    <input id="fileup" type="file" class="my-pond" name="filepond[]" multiple/>
@push('js')

    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        $(function () {
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginImageCrop);

            const inputElement = document.querySelector('#fileup');
            const pond = FilePond.create(inputElement, {
                // styleItemPanelAspectRatio:"1",
                imageCropAspectRatio: "1:1",
                storeAsFile: true,
                allowImageCrop: true,
                files: [
                        @foreach(App\Product::first()->image as $index=>$item)
                    {
                        source: '{{asset($item)}}',
                    },
                    @endforeach
                ],
            });
        });
    </script>
@endpush