<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">{{ __('master.'.$explanation->section ?? '') }}</h5>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="{{ $explanation->video_link ? 'col-md-4':'col-md-12' }} col-sm-12 ">
                         <div class="explanations-title">
                             <h3> {{ $explanation->title ?? '' }}  </h3>
                         </div>
                          <div class="explanations-description">
                             <p>
                                  {{ $explanation->description ?? '' }}
                             </p>
                          </div>
                    </div>
                    <div class="{{ $explanation->title && $explanation->description  ? 'col-md-8':'col-md-12' }} col-sm-12 container-video">
                        <video
                            id="my-player"
                            class="video-js vjs-fluid"
                            @if($type_resource == 'vimeo')
                               data-setup='{ "techOrder": ["vimeo"], "sources": [{ "type": "video/vimeo", "src": "{{ $explanation->video_link ?? '' }}"}], "vimeo": { "color": "#fbc51b"} }'
                            @else
                               controls
                               preload="auto"
                               poster="https://scontent.fcai3-2.fna.fbcdn.net/v/t1.6435-9/196873952_4152760701446779_8652042915717550950_n.jpg?_nc_cat=111&ccb=1-4&_nc_sid=973b4a&_nc_ohc=XCvk3geHK_4AX-nzFJL&_nc_ht=scontent.fcai3-2.fna&oh=1af59a79efd6ddd253850da7f700c3d3&oe=613A177B"
                               data-setup='{}'
                            @endif
                            >
                            @if($type_resource != 'vimeo')
                                <source src="{{ $explanation->video_link ?? '' }}" type="video/mp4"></source>
                                <source src="{{ $explanation->video_link ?? '' }}" type="video/webm"></source>
                                <source src="{{ $explanation->video_link ?? '' }}" type="video/ogg"></source>
                            @endif
                        </video>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-videojs close" data-dismiss="modal" aria-label="Close">{{ __('master.Close') }}</button>
        </div>

    </div>
</div>
<script>
  var player = videojs('my-player');
  player.play();
  player.fluid(true);
</script>
<style>
html[dir=rtl] .close{
    float: right;
}
 #my-player{
     width:100%;
 }

 .close-videojs
 {
    display: block;
    color: black;
    background-color: #e9e6e6 !important;
    padding: 3px 21px !important;
    opacity: 1;
 }
 @media (min-width:1000px){
    .container-video{
        min-height:500px;
    }
    .container-video #my-player{
        height:500px;
    }
 }
.explanations-title *
{
    padding: 10px;
    line-height: 2em;
    text-align: center;
}
.explanations-description p
{
    background-color: #e9f5ff;
    padding: 12px;
    line-height: 1.8em;
    text-align: center;
}
.video-js .vjs-big-play-button{
    background-color: #7c2c9e;
    text-align: center;
    border-radius: 0px;
}
.video-js .vjs-big-play-button .vjs-icon-placeholder:before {
    top:10px;
}
.video-js {
  width: 100%;
}
@media(max-width:1000px){
    .modal.fade .modal-dialog{
          width:100%;
    }
    #exampleModalCenter2 .modal-content{
        padding:0px !important;
    }
    .explanations-description p{
        font-size:13px !important;
    }
}
@media(min-width:1000px){
    .modal.fade .modal-dialog{
          width:80%;
    }
}
</style>
