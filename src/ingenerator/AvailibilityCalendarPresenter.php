<?php

namespace Acme\CalendarBundle\Worker;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\Persistence\ObjectManager;

use Acme\EventBundle\Document\Event;
use Acme\EventBundle\Entity\Venue;
// not sure we need to save the sales figure in a DB
// but it could prove useful for data analytics in the
// future
//use Acme\EventBundle\Entity\Sales;
use Acme\SalesProviderBundle\Worker\Sales;

class AvailabilityCalendarPresenter
{
    protected $dm;
    protected $om;
    protected $sales;

    /**
     * Constructor
     *
     * The arguments passed are service injected in the Symfony2 style
     * The Sales worker is actually reading the data provided from
     * sales.xml and is returning an associative array in the form:
     *
     * performanceId => array( 'capacity' => int, 'sold' => int )
     *
     * @param \Doctrine\ODM\MongoDB\DocumentManager $dm
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     * @param \Acme\SalesProviderBundle\Worker\Sales $sales
     */
    public function __construct( DocumentManager $dm, ObjectManager $om, Sales $sales )
    {
        $this->dm = $dm;
        $this->om = $om;
        $this->sales = $sales;
    }


    /**
     * @param string $venue_name
     * @param int    $month
     * @param int    $year
     */
    public function display( $venue_name, $month, $year )
    {
        // The application will call this method and expects to get back the data ready for display in the template.
        // Depending on your background you might be used to doing this work in your controller, viewmodel or view layer.
        // You DO NOT have to:
        // - implement any collaborator classes - just assume they exist and show how you'd use them.
        // - care about error handling - assume all input will be good
        // - care about performance - we'll assume that you'll refactor later if required.
        // - produce something that actually works. We'll ignore the odd typo too if your intent is clear.

        $venue = $this->om->getRepository( 'AcmeEventBundle:Venue' )->findOneBy( array(
            'name' => $venue_name
        ));

        $dates = $this->getStartAndEndDates( $month, $year, $venue->getTimeZone() );

        // we do not know if there is more than one performance for this venue
        $performances = $this->getEventPerformances( $venue_name, $dates['start'], $dates['end'] );

        $sales = array();
        foreach( $performances as $perf )
        {
            $sales[] = $this->getCurrentSalesData( $perf->getId() );
        }

        // Really if this is to be a service called to return a set of value
        // the rendering is up to the controller and the template, following
        // Symfony2 style.
        return array(
            'venue'     => $venue,
            'dates'     => $dates,
            'sales'     => $sales
        );
    }

    /**
     * Get the current sales data (ie capacity and sold_count
     *
     * If none are found for the $id provided return null
     *
     * @param int $id
     *
     * @return array | null
     */
    private function getCurrentSalesData( $id )
    {
        return ( in_array( $id, $this->sales ) ) ?
                $this->sales[ $id ] :
                null;
    }

    /**
     * Retrieve the event data based on the parameters passed.
     *
     * @param string $venue_name
     * @param string $start
     * @param string $end
     *
     * @return array
     */
    private function getEventPerformances( $venue_name, $start, $end )
    {
        // we will assume that event is an Object that has all the needed
        // informations. If not, then we will need to create one from the vendor
        // API and save it.
        $event = $this->dm->getRepository( 'AcmeEventBundle:Event' )
                      ->findBy( array( 'venue' => $venue_name ));

        return $event->getPerformances( $start, $end );
    }

    /**
     * This needs to be moved to a class/service that deals with
     * Date, Time and TimeZones.
     *
     * @param int $month
     * @param int $year
     * @param DateTimeZone $timeZone
     *
     * @return array
     */
    private function getStartAndEndDates( $month, $year, $timeZone )
    {
        $startDate = date( "Y-m-d H:i:s", mktime(0, 0, 0, $month, 1, $year) );
        $endDate = date( "Y-m-t H:i:s", mktime(23, 59, 59, $month, 1, $year) );

        return array(
            'start' => new DateTime( $startDate, $timeZone ),
            'end'   => new DateTime( $endDate, $timeZone )
        );
    }
}