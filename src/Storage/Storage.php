<?php

namespace Notify\Symfony\Storage;

use Notify\Envelope\Envelope;
use Notify\Envelope\Stamp\LifeStamp;
use Notify\Envelope\Stamp\UuidStamp;
use Symfony\Component\HttpFoundation\Session\Session;
use Notify\Storage\StorageInterface;

final class Storage implements StorageInterface
{
    const ENVELOPES_NAMESPACE = 'notify::envelopes';

    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function get()
    {
        return $this->session->get(self::ENVELOPES_NAMESPACE, []);
    }

    public function add(Envelope $envelope)
    {
        if (null === $envelope->get('Notify\Envelope\Stamp\UuidStamp')) {
            $envelope->withStamp(new UuidStamp());
        }

        $envelopes = $this->get();
        $envelopes[] = $envelope;

        $this->session->set(self::ENVELOPES_NAMESPACE, $envelopes);
    }

    /**
     * @param Envelope[] $envelopes
     */
    public function flush($envelopes)
    {
        $envelopesMap = [];

        foreach ($envelopes as $envelope) {
            $life = $envelope->get('Notify\Envelope\Stamp\LifeStamp')->getLife();
            $uuid = $envelope->get('Notify\Envelope\Stamp\UuidStamp')->getUuid();

            $envelopesMap[$uuid] = $life;
        }

        $store = [];

        foreach ($this->session->get(self::ENVELOPES_NAMESPACE, []) as $envelope) {
            $uuid = $envelope->get('Notify\Envelope\Stamp\UuidStamp')->getUuid();

            if(isset($envelopesMap[$uuid])) {
                $life = $envelopesMap[$uuid] - 1;

                if ($life <= 0) {
                    continue;
                }

                $envelope->with(new LifeStamp($life));
            }

            $store[] = $envelope;
        }

        $this->session->set(self::ENVELOPES_NAMESPACE, $store);
    }
}
