  <div class="form-body note needsclick">
        <div class="form-group">
            <div id="dpz-multiple-files" class="dropzone dropzone-area">
                <div class="dz-message">
                    {{__('master.more_t_o_imgs')}}
                </div>
                <div class="dz-preview  dz-processing dz-image-preview dz-complete">
                    <!--<div class="dz-image">-->
                    <!--  <img src="https://images.ctfassets.net/hrltx12pl8hq/3j5RylRv1ZdswxcBaMi0y7/b84fa97296bd2350db6ea194c0dce7db/Music_Icon.jpg" data-dz-thumbnail />-->
                    <!--</div>-->
                </div>
                
            </div>
            <br>
            <br>
        </div>
    </div>  
    @error('document')
        <span class="text-danger"> {{ $message }}</span>
    @enderror