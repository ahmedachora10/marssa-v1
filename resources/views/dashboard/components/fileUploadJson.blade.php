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
<input id="fileup" type="file" class="my-pond" name="@if(isset($name)){{$name}}[]@else image[] @endif" multiple/>
@push('js')
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        (function () {
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginImageCrop);

            //const inputElement = document.querySelector('#fileup');
            const pond = FilePond.create(inputElement, {
                // styleItemPanelAspectRatio:"1",
                imageCropAspectRatio: "1:1",
                storeAsFile: true,
                labelFileWaitingForSize: '{{__("master.file_size")}}',
                labelFileSizeNotAvailable: '{{__("master.file_size")}}',
                labelIdle: '{{__("Drag & Drop your files or")}} <span class="filepond--label-action"> {{__("Browse")}} </span>',
                allowImageCrop: true,
                credits: null,
                files: [
                        @isset($product)
                        @php
                            $product = json_decode($product);
                        @endphp
                        @foreach($product??[] as $index=>$item)
                    {
                        source: '{{asset($item)}}',
                    },
                    @endforeach
                    @endisset
                ],
            });
        })();
    </script>
@endpush
