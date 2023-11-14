<!-- Modal -->
</div>
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
</div>
<!-- end model -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.20.5/video.min.js"></script>
<script type="text/javascript" src="{{ asset('dashboard/light/assets/scripts/videojs-vimeo.min.js') }}"></script>

<script>
    jQuery(document).ready(function(){
        jQuery('.watch_video').click(function(e){
            e.preventDefault();
            let explanation_section = jQuery(this).attr('data-video-id');

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('video/explanations/') }}/"+explanation_section,
                method: 'GET',
                data: {
                    type:'ajax',
                },
                success: function(result){
                    if(!result.error){
                        jQuery('#exampleModalCenter2').modal('show');
                        jQuery('#exampleModalCenter2').html(result);
                    }else{
                       jQuery('#exampleModalCenter2').modal('hide')
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                   jQuery('#exampleModalCenter2').modal('hide');
                }
            });
        });
    });
    jQuery("#exampleModalCenter2").on('hidden.bs.modal', function(){
        var player = videojs('my-player');
        player.dispose();
        console.log('hi mohamed');
    });
</script>
