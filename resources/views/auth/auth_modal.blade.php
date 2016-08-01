<div id="modal" class="my_modal modal modal_tabs">
    <div class="modal-content">
       <ul class="tabs" >
           <li class="tab"><a class="active" href="#logare">LOGARE</a></li>
           <li class="tab"><a  href="#register">INREGISTRARE</a></li>
       </ul> 
        <div id="logare" class="col s12 tab_content">
            <div class="row">
                <div class="content_tab">
                    @include('auth.login_form')
                </div>
            </div>
        </div>
        <div id="register" class="col s12 tab_content">
            <div class="row">
                @include('auth.register_form') 
            </div>
            <br>
        </div>
    </div>
</div>

