<?php

namespace App\Actions;

class ApiController
{
    public function confirmReservation($request)
    {
        $email = $request['email'] ?? '';

        if (empty($email) || ! is_email($email)) {
            $response = rest_ensure_response('E-mailadres is niet geldig.');
            $response->set_status(400);

            return $response;
        }

        add_filter('wp_mail_content_type', function ($contentType) {
            return 'text/html';
        }, 10, 1);

        $sent = wp_mail($email, 'Uw reservering - Restaurant Sorrento', $this->formatMessage(), $this->emailHeaders());

        if (! $sent) {
            $response = rest_ensure_response('Er ging iets mis bij het versturen van de bevestiging.');
            $response->set_status(400);

            return $response;
        }

        $response = rest_ensure_response('Bevestiging verzonden.');
        $response->set_status(200);

        return $response;
    }

    protected function formatMessage(): string
    {
        return '
            <!DOCTYPE html>
            <html>
                <head>
                    <title>Uw reservering - Restaurant Sorrento</title>
                    <style>
                        body {
                            margin-top: 2vh;
                            height: 100vh;
                        }
                        table {
                            border-collapse: collapse;
                            text-align: center;
                        }
                        td {
                            padding: 10px;
                        }
                    </style>
                </head>
                <body>
                    <table>
                        <tr>
                            <td>
                                <img src="https://www.restaurantsorrento.nl/app/uploads/2023/01/cropped-sorrento.png" alt="sorrento logo" width="118" height="64">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Uw reservering is in goede orde bij ons binnengekomen en hierbij bevestigd.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Met vriendelijke groet, <br/>
                                Restaurant Sorrento
                            </td>
                        </tr>
                    </table>
                </body>
            </html>';
    }

    protected function emailHeaders(): string
    {
        $headers = '';
        $headers .= 'From: Restaurant Sorrento <info@restaurantsorrento.nl>';

        return $headers;
    }
}
