@php
    $logoImg = 'public/storage/banner_picture/'.@$logo->logo_image;
@endphp
<form action="{{ route('search-filter') }}" id="serch-form-footer">
    <input type="hidden" name="keyword_footer" id="keyword_footer">
    <input type="hidden" name="property_type_footer" id="property_type_footer">
    <input type="hidden" name="search_type" id="search_type_footer" value="">
</form>
<a href="" id="searchSubmit"></a>
<section class="bottom section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-lg-3">
                        <div class="bottom-logo">
                            @if(@getimagesize($logoImg))
                            <img src="{{asset($logoImg)}}" alt="" class="img-fluid">
                            @else
                            <img src="{{asset('public/assets/images/logo.png')}}" alt="" class="img-fluid">
                            @endif

                            @if(@$logo->description)
                                <p>{{$logo->description}}</p>
                            @else
                                <p>Landcapture.com is an online real estate site that links realtors and sellers with potential buyers.</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-lg-3">
                            <div class="bottom-list">
                                <h3>Real Estate by Type</h3> 
                                <ul>
                                    @if(!empty($footer_menu1))
                                        @foreach($footer_menu1 as $fmenu1)
                                            <li><a href="{{env('APP_URL')}}/united-states/type-land/propertytype-{{@$fmenu1->property}}" data-id="{{@$fmenu1->property}}">{{@$fmenu1->getProperty->title}}</a></li>
                                             <!-- class="footer_property" -->
                                        @endforeach
                                    @endif
                                </ul>
                            </div><!--bottom-list end-->
                        </div>
                    <div class="col-xl-3 col-sm-6 col-lg-3">
                        <div class="bottom-list">
                            <h3>Real Estate by State</h3>
                            <ul class="top-five">
                                @if(!empty($footer_menu2))
                                    @foreach($footer_menu2 as $fmenu2)
                                    @php
                                    $url_name = str_replace(" ","_",$fmenu2->getState->name);
                                    @endphp
                                        <li><a href="{{env('APP_URL')}}/areas-state-{{$url_name}}/type-land" data-name="{{$fmenu2->getState->name}}">{{$fmenu2->getState->name}}</a></li>
                                         <!-- class="footer_state" -->
                                    @endforeach
                                @endif
                                <li class="show-all">More <i class="fa fa-angle-down"></i></li>
                            </ul>
                            <ul class="all-states" style="display: none;">
                                @foreach($states as $state)
                                @php
                                $url_name = str_replace(" ","_",$state->name);
                                @endphp
                                    <li><a href="{{env('APP_URL')}}/areas-state-{{$url_name}}/type-land" data-name="{{$state->name}}">{{$state->name}}</a></li>
                                @endforeach
                                <li class="hide-all">Less <i class="fa fa-angle-up"></i></li>
                            </ul>
                        </div><!--bottom-list end-->
                    </div>
                    <div class="col-xl-3 col-sm-6 col-lg-3">
                        <div class="bottom-list">
                            <h3>About Us</h3>
                            <ul>   
                                @if(!empty($footer_menu3))                
                                    @foreach($footer_menu3 as $fmenu3)
                                        @if($fmenu3->menu_type == "content")  
                                            <li><a href="{{route('content.page',$fmenu3->slug)}}" title="">{{$fmenu3->menu_name}}</a></li>
                                        @else
                                            <li><a href="{{$fmenu3->url}}" title="">{{$fmenu3->menu_name}}</a></li>
                                        @endif
                                    @endforeach    
                                @endif 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="footer-content">
                            <div class="row justify-content-between">
                                <div class="col-xl-6 col-md-6">
                                    <div class="copyright">
                                        <p>&copy;  Activteam. All Rights Reserved.</p>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="footer-social">
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

@push('scripts')
<script type="text/javascript">        
    $(document).ready(function(e){

      $('.footer_property').click(function(){
        var val = $(this).data('id');
        // $("#property_type_footer").val(val);
        // $('#serch-form-footer').submit();
        let url = "";
        url += `united-states/type-land/propertytype-${val}`;
        let form_url = "{{env('APP_URL')}}" + '/' + url;
        $('#searchSubmit').attr('href',form_url);
        $('#searchSubmit')[0].click();
        // alert(form_url);
        // window.location = form_url;
      });

      $('.footer_state').click(function(){
        var val = $(this).data('name');
        // $("#keyword_footer").val(val);
        // $("#search_type_footer").val('state');
        // $('#serch-form-footer').submit();
          let url = "";
        
          var replaced = val.replace(/\s/g, '_'); 
          url += `areas-state-${replaced}/type-land/`;
          let form_url = "{{env('APP_URL')}}" + '/' + url;
          $('#searchSubmit').attr('href',form_url);
          $('#searchSubmit')[0].click();
          // alert(form_url);
          // window.location = form_url;
      });

    $('.state-show').click(function(){
        $('.banner').hide();
        $('.map-banner').show();
    });

    $('.close-state').click(function(){
        $('.map-banner').hide();
        $('.banner').show();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });          
            
    $('#feedback_form').submit(function(e) {
        e.preventDefault();

        // recaptcha checking
        var recaptcha = $("#g-recaptcha-response").val();
        if (recaptcha === "") {
            event.preventDefault();
            $('#recap_show').show();
            return false;
        } else {
            $('#recap_show').hide();      
        }
        
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ route('save.feedback')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#feedback_btn').prop('disabled', true);
                $('#feedback_btn').html('Sending...');
            },
            success:function(response){
                if(response.success) {
                    $(".msg-sccs").show();
                    $("#feedback_form")[0].reset();
                    $('#feedback_btn').prop('disabled', false);
                    $('#feedback_btn').html('Submit');
                    setTimeout(function() {
                        $('.msg-sccs').fadeOut('slow');
                    }, 5000);
                } else {
                    $(".msg-err").hide();
                }
            }
        });
    });

      $('.show-all').click(() => {
        $('.top-five').hide();
        $('.all-states').show();
      });

      $('.hide-all').click(() => {
        $('.all-states').hide();
        $('.top-five').show();
      });
    });
</script>

  <script>
    $("path, circle").hover(function(e) {
      $('#info-box').css('display','block');
      $('#info-box').html($(this).data('info'));
    });

    $("path, circle").click(function(e) {
      var search = $(this).data('state');
      // $('#keyword_footer').val(search);
      // $("#search_type_footer").val('state');
      // $('#serch-form-footer').submit();
      let url = "";
        
      var replaced = search.replace(/\s/g, '_'); 

      url += `areas-state-${replaced}/type-land/`;
      let form_url = "{{env('APP_URL')}}" + '/' + url;
      $('#searchSubmit').attr('href',form_url);
      $('#searchSubmit')[0].click();
      // alert(form_url);
      // window.location = form_url;
    });

    $("path, circle").mouseleave(function(e) {
      $('#info-box').css('display','none');
    });

    $(document).mousemove(function(e) {
      $('#info-box').css('top',e.pageY-$('#info-box').height()-30);
      $('#info-box').css('left',e.pageX-($('#info-box').width())/2);
    }).mouseover();

    var ios = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    if(ios) {
      $('a').on('click touchend', function() { 
        var link = $(this).attr('href');   
        window.open(link,'_blank');
        return false;
      });
    }
  </script>
@endpush