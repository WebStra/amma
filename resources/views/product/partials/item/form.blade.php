@if($lot->vendor->user->id !== \Auth::id())

    @if(! $user_is_involved)
        <form class="row childs_margin_top" method="post"
              action="{{ route('involve_product', ['product' => $item->id]) }}">
            <div class="counting col l6 m6 s12">
                <div class="wrapp_input">
                    <span class="minus left in"><i class="icon-minus"></i></span>
                    <input type="text" readonly="readonly" value="1" name="count">
                    <span class="plus right in"><i class="icon-plus"></i></span>
                </div>
            </div>
            <div class="col l6 m6 s12">
                <button type="submit" class="btn_ full_width btn_base put_in_basket">
                    <i class="icon-basket"></i>
                    <span class="hide-on-med-only"><!--Adaugă în coș-->Participa</span>
                </button>
            </div>
        </form>
    @else
        <form class="row childs_margin_top" method="post"
              action="{{ route('involve_product_cancel', ['involved' => $involved->id]) }}">
            <div class="col l6 m6 s12">
                <button type="submit" class="btn_ full_width btn_base  put_in_basket">
                    <i class="icon-basket"></i>
                    <span class="hide-on-med-only"><!--Adaugă în coș-->Exit</span>
                </button>
            </div>
        </form>
    @endif
@endif