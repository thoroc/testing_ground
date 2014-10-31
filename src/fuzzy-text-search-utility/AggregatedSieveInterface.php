<?php

namespace Absolvent\FuzzyText;

interface AggregatedSieveInterface extends SieveInterface
{
    /**
     * @param \Absolvent\FuzzyText\SieveInterface $sieve
     * @param integer $priority the higher number, the closer position to the
     *                          head of the queue
     * @return void
     */
    function addSieve(SieveInterface $sieve, $priority = 0);

    /**
     * Insert sieve at the end of the queue
     *
     * @param \Absolvent\FuzzyText\SieveInterface $sieve
     * @return void
     */
    function enqueueSieve(SieveInterface $sieve);

    /**
     * Remove sieve from the end of the queue and return it
     *
     * @return \Absolvent\FuzzyText\SieveInterface
     */
    function dequeueSieve();

    /**
     * @return int
     */
    function getHighestPriority();

    /**
     * @return int
     */
    function getLowestPriority();

    /**
     * Remove sieve from the top of the queue and return it
     *
     * @return \Absolvent\FuzzyText\SieveInterface
     */
    function popSieve();

    /**
     * Insert sieve at the top of the queue
     *
     * @param \Absolvent\FuzzyText\SieveInterface $sieve
     * @return void
     */
    function pushSieve(SieveInterface $sieve);

    /**
     * @param \Absolvent\FuzzyText\SieveInterface $sieve
     * @return void
     */
    function removeSieve(SieveInterface $sieve);
}
