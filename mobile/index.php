<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Mobile BTC Viewer</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="css/custom.css" />
    </head>
    <body>
        <div class="container">
            <div class="col-xs-12">
                BTC Payout Address:
                <p><small id="btcpayaddr">loading...</small></p>
                <i class="fa fa-btc" aria-hidden="true"></i> Value:
                <p id="btcvalue">loading...</p>
            </div>
            <div class="col-xs-12">
                Satoshis mined:
                <p class="font-weight-bold display-3" id="satoshi_amount">...</p>
                Converted to Bitcoin:
                <p class="font-weight-bold h2" id="btc_amount">... <i class="fa fa-btc" aria-hidden="true"></i></p>
                Converted to EUR:
                <p class="font-weight-bold h2" id="eur_amount">... <i class="fa fa-eur" aria-hidden="true"></i></p>
            </div>
            <footer class="footer">
                <div class="container">
                    <span class="text-muted refresh-counter">Place here.</span>
                </div>
            </footer>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </body>
</html>