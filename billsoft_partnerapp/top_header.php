 <header class="header">
            <div class="row">
                <div class="col-auto px-0">
                    <button class="menu-btn btn btn-40 btn-link" type="button">
                        <span class="material-icons">menu</span>
                    </button>
                </div>
                <div class="text-left col align-self-center colorsettings" style="padding-left: 0px;width: 100px;">
                   
                    <a class="navbar-brand" href="#">
                        <h5 class=" mb-0" style="font-size: 11px;">MAHA CHAI PVT LTD </h5>
                        <p class="" style="font-size: 9px;color: #fff;"></p>

                    </a>
                
                </div>

                <div class="ml-auto col-auto pl-0">

                    <button type="button" class="btn btn-link btn-40 colorsettings">
                        <span class="material-icons">keyboard_arrow_down</span>
                    </button>

                    <button type="button" class="btn btn-link btn-40 colorsettingss" onclick="showCalender()">
                        <span class="material-icons">calendar_month</span>
                    </button>

                    <a href="javascript:window.location.href=window.location.href"><button type="button" class="btn btn-link btn-40">
                        <span class="material-icons">refresh</span>
                    </button></a>

                    
                    <a href="#" class="avatar avatar-30 shadow-sm rounded-circle ml-2">
                        <figure class="m-0 background">
                            <img src="img/user1.png" alt="">
                        </figure>
                    </a>
                </div>
            </div>
        </header>
        <script type="text/javascript">
            function showCalender(){
                $('.color-picker2').addClass('active');
            }
            function closeCalender(){
                $('.color-picker2').removeClass('active');
            }
        </script>