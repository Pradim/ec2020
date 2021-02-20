<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Your Cart
                </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @if(session('cart'))
                    @foreach(session('cart') as $cart)
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="{{ $cart['image'] }}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="{{ $cart['link'] }}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    {{ $cart['title'] }}
                                </a>

                                <span class="header-cart-item-info">
                                        {{ $cart['quantity'] }} x {{ $cart['actual_price'] }}
                                    </span>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>

            <div class="w-full">
                    @php
                        $total_product = 0;
                        $total_amount = 0;
                        if(session('cart')){
                            foreach(session('cart') as $cart){
                                $total_amount += $cart['total_amount'];
                            }   
                        }
                    @endphp
                <div class="header-cart-total w-full p-tb-40">
                    Total: NPR. {{ number_format($total_amount) }}
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    @if(session('cart'))
                        <a href="{{ route('view-cart') }}"
                           class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            View Cart
                        </a>

                        <a href="{{ route('checkout') }}"
                           class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Check Out
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>