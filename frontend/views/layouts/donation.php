<!-- Donation -->
<section class="page-section color" id="donation">
    <div class="container">
        <h1 class="section-title">
            <span data-animation="flipInY" data-animation-delay="300" class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-ticket fa-stack-1x"></i></span></span>
            <span data-animation="fadeInRight" data-animation-delay="500" class="title-inner">Donation <small> / lorem ipsum</small></span>
        </h1>
        <p>Etiam molestie, quam eget dignissim dapibus, diam libero auctor justo, a eleifend urna tellus et ligula. Curabitur elementum diam nec lacus pretium.</p>

        <!-- Make a donation now
        https://developer.paypal.com/webapps/developer/docs/classic/paypal-payments-standard/integration-guide/Appx_websitestandard_htmlvariables/
        -->
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <!-- Identify your business so that you can collect the payments. -->
            <input type="hidden" name="business" value="yourpaypalemail@domain.com">
            <!-- Specify a Donate button. -->
            <input type="hidden" name="cmd" value="_donations">
            <!-- Specify details about the contribution -->
            <input type="hidden" name="item_name" value="Donate">
            <input type="hidden" name="item_number" value="">
            <input type="hidden" name="amount" value="25.00">
            <input type="hidden" name="currency_code" value="USD">
            <!-- Display the payment button. -->
            <button name="submit" class="btn btn-theme">Make a donation now</button>
            <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
        </form>

    </div>
</section>
<!-- /Donation -->