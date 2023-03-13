<?php
    require_once("PayPal-PHP-SDK/autoload.php");

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AQ2PJjr0hXhqL_dxo6g0dKGF5_vtu7BC1hlN13FhkVADtTogXLJeh5YjyfFqrCqv4vILYo4Al49IVOz3',     // ClientID
            'ELIaMXKcjcpBRzIQlLaKCQFoNQADH0uF2sFkDlkfPPfLWTCvehflrNLTUqbQhJZwJX7x02IaqErFgpU5'      // ClientSecret
        )
    );
?>