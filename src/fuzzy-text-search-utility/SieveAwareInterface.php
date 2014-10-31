<?php

namespace Absolvent\FuzzyText;

interface SieveAwareInterface
{
    /**
     * @param \Absolvent\FuzzyText\SieveInterface $sieve (optional) (default: null)
     * @return void
     */
    function setSieve(SieveInterface $sieve = null);
}
