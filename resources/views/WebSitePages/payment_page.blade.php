@extends('layout.websiteInside')
@section('content')
    <!-- content -->
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <h2 class="text-center">Scholarship Payment</h2>
                    <form action="{!!route('checkPayment')!!}" method="POST" id="paymentForm">
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZOR_KEY') }}"
                                data-amount="{{session("registration_fee")}}"
                                data-buttontext="Pay Amount"
                                data-name="CSPIS"
                                data-email="info@cspis.org"
                                data-description="Registration Fee"
                                data-theme.color="#ff7529">
                        </script>
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <script type="text/javascript">

     $(document).ready(function() {
            $("#paymentForm").submit();
        });
        
    </script>
@endsection
