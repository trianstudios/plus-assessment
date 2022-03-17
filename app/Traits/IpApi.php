<?php


namespace App\Traits;


use App\Http\Requests\Auth\LoginRequest;
use App\Models\Throttle;
use App\Notifications\NotifyUserOfLogin;
use Illuminate\Support\Facades\Http;

trait IpApi
{
    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    protected function getIpDetails(String $idAddress)
    {
        $response = Http::get("http://ip-api.com/php/{$idAddress}");

        if($response->successful()){
            return unserialize($response->body());
        }

        return $response->throw();
    }

    protected function constructIpLocation(array $ipApi): ?string
    {
        if(count($ipApi) === 0) return null;
        return $ipApi['country'] . ' - ' . $ipApi['region'] . ' - ' . $ipApi['city'] . ' - ' . $ipApi['zip'] . " - (latitude: {$ipApi['lat']}, longitude: {$ipApi['lon']})";
    }

    /**
     * @param LoginRequest $request
     */
    public function validateThrottler(LoginRequest $request): void
    {
        $ipAddr = ($request->ip() !== '127.0.0.1') ? $request->ip() : '24.48.0.1'; // NB: 24.48.0.1 is used to test with a live location.

        try {
            $ipApi = $this->getIpDetails($ipAddr);
        } catch (\Exception $e) {
            $this->destroy($request);
        }

        $ipLocation = $this->constructIpLocation($ipApi ?? []);

        if (($throttler = Throttle::where('user_id', auth()->id())->get()) && $throttler->isNotEmpty()) {

            $checker = [];

            foreach ($throttler as $item) {

                if (trim($item->ip_address) === trim($ipAddr) && $item->user_agent === $request->header('User-Agent')) {
                    $checker[] = 'found';
                }

            }

            if (count($checker) === 0) {

                Throttle::Create([
                    'user_id' => auth()->id(),
                    'ip_address' => $ipAddr,
                    'ip_location' => $ipLocation,
                    'login_at' => now(),
                    'user_agent' => $request->header('User-Agent')
                ]);

                auth()->user()->notify(new NotifyUserOfLogin($ipLocation));

            }

        } else {

            Throttle::Create([
                'user_id' => auth()->id(),
                'ip_address' => $ipAddr,
                'ip_location' => $ipLocation,
                'login_at' => now(),
                'user_agent' => $request->header('User-Agent')
            ]);

        }
    }
}
