@if($lot->description)
    <div class="col l12 m12 s12 product_vendor_block">
        <div class="bordered divide-top">
            <div class="block_title">DESCRIEREA LOTULUI</div>
            <div class="person_card">
                <div class="about_lot_single_prod">
                    <span class="c-gray showmore">{{$lot->description}}</span>
                </div>
            </div>
        </div>
    </div>
@endif
@if($lot->description_delivery)
    <div class="col l12 m12 s12 product_vendor_block">
        <div class="bordered divide-top hide-on-small-only">
            <div class="block_title">DATE DESPRE LIVRARE</div>
            <div class="person_card">
                <div class="about_lot_single_prod">
                    <span class="c-gray showmore">{{$lot->description_delivery}}</span>
                </div>
            </div>
        </div>
    </div>
@endif
@if($lot->description_payment)
    <div class="col l12 m12 s12 product_vendor_block">
        <div class="bordered divide-top hide-on-small-only">
            <div class="block_title">PRETURI LA LIVRARE</div>
            <div class="person_card">
                <div class="about_lot_single_prod">
                    <span class="c-gray showmore">{{$lot->description_payment}}</span>
                </div>
            </div>
        </div>
    </div>
@endif