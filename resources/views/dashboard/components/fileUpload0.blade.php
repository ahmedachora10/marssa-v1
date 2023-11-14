
<style media="screen">
.custom-file-container__custom-file {
  box-sizing: border-box;
  position: relative;
  display: inline-block;
  width: 100%;
  height: calc(2.25rem + 2px);
  margin-bottom: 0;
  margin-top: 5px;
  text-align: -webkit-center;
  font-size: 16px;
  text-transform: uppercase;
  font-weight: 600;
}
</style>


        <link
            rel="stylesheet"
            type="text/css"
            href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css"
        />

        <div class="custom-file-container" data-upload-id="myUniqueUploadId">
    <label
        >Upload File
        <a
            href="javascript:void(0)"
            class="custom-file-container__image-clear"
            title="Clear Image"
            >&times;</a
        ></label
    >
    <label class="custom-file-container__custom-file">
        <input
        id="upload"
            type="file"
            class="custom-file-container__custom-file__custom-file-input"
            accept="image/png, image/jpeg, image/gif"
            multiple
            aria-label="{{ __('master.ff') }}"
            name="image[]"
        />
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        <span
            class="custom-file-container__custom-file__custom-file-control aaa"
        ></span>
    </label>
    <div class="custom-file-container__image-preview"  onclick="document.getElementById('upload').click(); return false" ></div>
</div>






        <script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
        <script>
            var upload = new FileUploadWithPreview("myUniqueUploadId", {
                showDeleteButtonOnImages: true,
                text: {
                    chooseFile: "Custom Placeholder Copy",
                    browse: "Custom Button Copy",
                    selectedCount: "Custom Files Selected Copy",
                },
                images: {
                    baseImage: importedBaseImage,
                },
                presetFiles: [
                    "https://images.unsplash.com/photo-1557090495-fc9312e77b28?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=668&q=80",
                ],
            });
        </script>

<script>
    var upload = new FileUploadWithPreview("myUniqueUploadId");
</script>
