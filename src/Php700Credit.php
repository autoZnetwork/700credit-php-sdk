<?php

namespace Autoznetwork\Php700Credit;

use Autoznetwork\Php700Credit\Classes\Consumer\Consumer;
use Autoznetwork\Php700Credit\Classes\Consumer\Cosigner;
use Autoznetwork\Php700Credit\Classes\Credentials;
use Autoznetwork\Php700Credit\Classes\Util;
use Autoznetwork\Php700Credit\Classes\Vehicle\TradeInVehicle;
use Autoznetwork\Php700Credit\Classes\Vehicle\Vehicle;
use Autoznetwork\Php700Credit\Enums\Bureau;
use Autoznetwork\Php700Credit\Enums\Environment;
use Autoznetwork\Php700Credit\Exceptions\CreditSystemError;
use Autoznetwork\Php700Credit\Exceptions\InvalidResponse;
use Autoznetwork\Php700Credit\Requests\CreditRequest;
use Autoznetwork\Php700Credit\Requests\PreQualifyRequest;
use Autoznetwork\Php700Credit\Requests\SaveOnlyRequest;
use Autoznetwork\Php700Credit\Traits\Conditionable;
use Saloon\Contracts\Body\HasBody;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Traits\Body\HasFormBody;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\XmlWrangler\Exceptions\QueryAlreadyReadException;
use Saloon\XmlWrangler\Exceptions\XmlReaderException;
use Saloon\XmlWrangler\XmlReader;
use Throwable;

class Php700Credit extends Connector implements HasBody
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use Conditionable;
    use HasFormBody;

    //    protected Environment $environment = Environment::PRODUCTION;
    protected Environment $environment = Environment::TESTING;

    protected ?Consumer $consumer = null;

    protected ?Cosigner $cosigner = null;

    protected ?Vehicle $vehicle = null;

    protected ?TradeInVehicle $tradeInVehicle = null;

    protected bool $troubleshootRequest = false;

    protected array $bureaus = [];

    /**
     * By default, 700Credit will check for duplicates before sending. Enabling this will bypass the default logic and
     * send the request directly to the bureau(s).
     */
    protected bool $bypassDuplicateCheck = false;

    public function __construct(protected ?Credentials $credentials = null) {}

    public function resolveBaseUrl(): string
    {
        return $this->environment === Environment::PRODUCTION
            ? Config::$productionUrl
            : Config::$testUrl;
    }

    public function credentials(Credentials $credentials): static
    {
        $this->credentials = $credentials;

        return $this;
    }

    public function troubleshootRequest(): static
    {
        $this->troubleshootRequest = true;

        return $this;
    }

    public function consumer(Consumer $consumer): static
    {
        $this->consumer = $consumer;

        return $this;
    }

    public function cosigner(Cosigner $cosigner): static
    {
        $this->cosigner = $cosigner;

        return $this;
    }

    public function vehicle(Vehicle $vehicle): static
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function tradeInVehicle(TradeInVehicle $tradeInVehicle): static
    {
        $this->tradeInVehicle = $tradeInVehicle;

        return $this;
    }

    public function bureaus(string|array|Bureau $bureaus): static
    {
        if (! is_array($bureaus)) {
            $bureaus = [$bureaus];
        }

        $this->bureaus = Util::formatImplicitBureausToEnums($bureaus);

        return $this;
    }

    public function getBureaus(): array
    {
        return $this->bureaus;
    }

    public function testing(): static
    {
        $this->environment = Environment::TESTING;

        return $this;
    }

    public function bypassDuplicateCheck(): static
    {
        $this->bypassDuplicateCheck = true;

        return $this;
    }

    /**
     * @throws Throwable
     * @throws QueryAlreadyReadException
     * @throws XmlReaderException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws InvalidResponse
     */
    public function credit(): array
    {
        $res = $this->sendRequest(
            new CreditRequest(
                credentials: $this->credentials,
                consumer: $this->consumer,
                cosigner: $this->cosigner,
                vehicle: $this->vehicle,
                tradeInVehicle: $this->tradeInVehicle,
            )
        );

        if ($this->troubleshootRequest) {
            return $res;
        }

        $report = $res->value('Results')->first();

        if (is_null($report)) {
            throw new InvalidResponse('Invalid credit response.');
        }

        return $report;
    }

    /**
     * @throws Throwable
     * @throws QueryAlreadyReadException
     * @throws XmlReaderException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws InvalidResponse
     */
    public function preQualify(): array
    {
        $res = $this->sendRequest(
            new PreQualifyRequest(
                credentials: $this->credentials,
                consumer: $this->consumer,
            )
        );

        if ($this->troubleshootRequest) {
            return $res;
        }

        $report = $res->value('XML_Report')->first();

        if (is_null($report)) {
            throw new InvalidResponse('Invalid prequalify response.');
        }

        return $report;
    }

    /**
     * @throws Throwable
     * @throws QueryAlreadyReadException
     * @throws XmlReaderException
     * @throws FatalRequestException
     * @throws RequestException
     * @throws InvalidResponse
     */
    public function saveOnly(): array
    {
        $res = $this->sendRequest(
            new SaveOnlyRequest(
                credentials: $this->credentials,
                consumer: $this->consumer,
                cosigner: $this->cosigner,
                vehicle: $this->vehicle,
                tradeInVehicle: $this->tradeInVehicle,
            )
        );

        if ($this->troubleshootRequest) {
            return $res;
        }

        $report = $res->value('Results')->first();

        if (is_null($report)) {
            throw new InvalidResponse('Invalid saveonly response.');
        }

        return $report;
    }

    /**
     * @throws FatalRequestException
     * @throws CreditSystemError
     * @throws RequestException
     */
    protected function sendRequest($request): XmlReader|array
    {
        if ($this->troubleshootRequest) {
            $body = array_merge($this->body()->all(), $request->body()->all());

            return [
                'body' => $body,
            ];
        }

        $xmlReader = $this->send($request)->xmlReader();
        $this->checkForCreditSystemError($xmlReader);

        return $xmlReader;
    }

    protected function defaultBody(): array
    {
        $body = [
            'PASS' => 2,
            'PROCESS' => 'PCCCREDIT',
        ];

        if ($this->bypassDuplicateCheck) {
            $body['APP_MODIFIED'] = 'Y';
        }

        if (count($this->bureaus) > 0) {
            $bureausMapped = array_unique(array_map(fn (Bureau $bureau) => $bureau->value, $this->bureaus));
            $bureauKey = count($bureausMapped) === 1 ? 'BUREAU' : 'MULTIBUR';

            $body[$bureauKey] = implode(':', $bureausMapped);
        }

        return $body;
    }

    /**
     * @throws CreditSystemError
     */
    protected function checkForCreditSystemError($xmlReader): void
    {
        /**
         * @var array|null $errorCheck
         */
        $errorCheck = $xmlReader->element('Creditsystem_Error')->first()?->getAttributes();

        if (! is_null($errorCheck)) {
            throw new CreditSystemError($errorCheck['id'], $errorCheck['message']);
        }
    }
}
