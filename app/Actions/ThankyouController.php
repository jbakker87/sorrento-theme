<?php

namespace App\Actions;

use \WC_Abstract_Order;

class ThankyouController
{
    protected string $mollieAPIKey;
    
    public function __construct()
    {
        $this->mollieAPIKey = env('MOLLIE_API_KEY', '');
    }

    /**
     * After a succesfull payment via iDeal the status of the order should be completed.
     * Unfortunately the status gets stuck on 'pending'.
     * Request the Mollie API and validate if the status is paid.
     * When it is, set status to 'completed'.
     */
    public function handle(int $orderID): void
    {
        $order = \wc_get_order($orderID);

        if (! $order instanceof WC_Abstract_Order) {
            return;
        }
        
        $paymentID = \get_post_meta($orderID, '_mollie_payment_id', true);

        if (empty($this->mollieAPIKey) || empty($paymentID)) {
            return;
        }

        $paymentDetails = $this->getPaymentDetails($paymentID);

        if (! $this->iDealPayment($paymentDetails)) {
            return;
        }

        if (! $this->statusIsPaid($paymentDetails)) {
            return;
        }

        $order->set_status('completed', '', true);
        $order->save();
    }

    protected function getPaymentDetails(string $paymentID): array
    {
        $url  = sprintf('https://api.mollie.com/v2/payments/%s', $paymentID);
        $args = [
            'headers'     => [
                'Authorization' => sprintf('Bearer %s', $this->mollieAPIKey),
            ],
        ];

        $result = \wp_remote_get($url, $args);

        if (\is_wp_error($result)) {
            return [];
        }
        
        $body = json_decode(\wp_remote_retrieve_body($result), true);

        if (\is_wp_error($body)) {
            return [];
        }

        return $body;
    }

    protected function iDealPayment(array $paymentDetails): bool
    {
        $method = $paymentDetails['method'] ?? '';

        return 'ideal' === $method;
    }

    protected function statusIsPaid(array $paymentDetails): bool
    {
        $status = $paymentDetails['status'] ?? '';

        return 'paid' === $status;
    }
}
