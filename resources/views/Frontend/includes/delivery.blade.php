<!-- Delivery -->
<div class="delivery-info">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="info-single">
                    <i class="fa fa-shopping-cart"> </i>
                    <div class="info-content">
                        <h4>Order a dish</h4>
                        <p>
                {!! $orderDish->details ?? '' !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-single">
                    <i class="fa fa-credit-card"> </i>
                    <div class="info-content">
                        <h4>Make payment</h4>
                        <p>
                           {!! $makePayment->details ?? '' !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-single">
                    <i class="fa fa-box"> </i>
                    <div class="info-content">
                        <h4>Receive your food</h4>
                        <p>
                  {!! $receiveFood->details ?? '' !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
