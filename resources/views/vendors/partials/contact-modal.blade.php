<div id="contact-modal" class="contact_vendor_ modal">
    <div class="modal-content">
        <p class="message_sent_succesful"></p>
        <div class="row">
            <form method="POST" data-action="{{route('vendor_send_message',['vendor'=>$vendor->id])}}" class="col s12">
                {{csrf_field()}}
                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="name" type="text" name="name" class="validate">
                    <label for="name" data-error="">Nume</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">phone</i>
                    <input id="phone" type="text" name="phone" class="validate">
                    <label for="phone" data-error="">Telefon</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input id="email" type="text" name="email" class="validate">
                    <label for="email" data-error="">E-mail</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="message" name="message" class="materialize-textarea"></textarea>
                    <label for="message">Mesaj</label>
                </div>
                <div class="input-field" style="float: right;">
                    <input type="submit" class="btn send_vendor_message" value="Trimite">
                </div>
            </form>
        </div>
    </div>
</div>