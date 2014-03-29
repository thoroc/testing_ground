<?php

namespace Acme\CalendarBundle\Worker;

use Doctrine\ODM\MongoDB\DocumentManager;

use Acme\EventBundle\Document\Event;
use Acme\EventBundle\Entity\Venue;
// not sure we need to save the sales figure in a DB
// but it could prove useful for data analytics in the
// future
//use Acme\EventBundle\Entity\Sales;
use Acme\SalesProviderBundle\Worker\XmlParser;

class AvailabilityCalendarPresenter
{
    protected $dm;
    protected $parser;

    public function __construct( DocumentManager $dm, XmlParser $parser )
    {
        $this->dm = $dm;
        $this->parser = $parser;
    }

    private function getSalesData( $performanceId, $start, $end )
    {
        return 'foo';
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

        $eventData = $this->getEventData( $venue_name );
    }

    private function getEventData( $venue_name, $start, $end )
    {
        $event = $this->dm->getRepository( 'AcmeEventBundle:Event' )
                      ->findBy( array( 'venue' => $venue_name ));

        return $event->getPerformances( $start, $end );
    }

    private function getStartAndEndDates( $month, $year )
    {
        return array(
            'start' => date('m-01-Y 00:00:00',strtotime('this month')),
            'end'   => date('m-01-Y 00:00:00',strtotime('this month'))
        );
    }
}


$thisYear = 2014;
$thisMonth = 2;

echo '<p>Month = ' . $thisMonth . ', Year = ' . $thisYear . '</p>';
echo '<p>Start Date</p>';
echo '<p>' . date( "Y-m-d", mktime(0, 0, 0, $thisMonth, 1, $thisYear) ) . '</p>';
echo '<p>End Date</p>';
echo '<p>' . date( "Y-m-t", mktime(0, 0, 0, $thisMonth, 1, $thisYear) ) . '</p>';