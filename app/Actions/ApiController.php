<?php

namespace App\Actions;

class ApiController
{
    function ConfirmReservation($request)
    {
        if (isset($request['email']))
        {
            $email = $request['email'];

            $message = '
            <html>
            <head>
            <title>Uw reservering werd bevestigd</title>
            </head>
            <body>
            <img src="https://www.restaurantsorrento.nl/app/uploads/2023/01/cropped-sorrento.png" alt="sorrento logo" width="118" height="64">
            <p>Nogmaals hartelijk dank voor uw reservering bij Sorrento. Wij bevestigen u hierbij dat uw reservering door ons is bevestigd.</p>
            </body>
            </html>';
        
            $info = [
                'to' => $email,
                'subject' => 'Uw reservering bij Sorrento is bevestigd.',
                'message' => $message,
            ];
        
            if (\is_email($email))
            {
                $headers = 'From: Restaurant Sorrento <info@restaurantsorrento.nl>';
                $sent = mail($info["to"], $info["subject"], $info["message"], $headers);
        
                if ($sent)
                {
                    $response = rest_ensure_response("Bevestiging werd verzonden.");
                    $response->set_status(200);
    
                    return $response;
                }
                else
                {
                    $response = rest_ensure_response("Er ging iets mis bij het versturen van de bevestiging.");
                    $response->set_status(400);
        
                    return $response;
                }
            }
        }
        else
        {
            $response = rest_ensure_response("Er ging iets mis.");
            $response->set_status(500);

            return $response;
        }
    }
}