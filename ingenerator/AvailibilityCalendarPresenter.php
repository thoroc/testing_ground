?<php

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

    private function getSalesData( $performanceId )
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
        $dates = $this->getStartAndEndDates( $month, $year, $timeZone );
        $eventData = $this->getEventData( $venue_name, $dates['start'], $dates['end'] );
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
    private function getEventData( $venue_name, $start, $end )
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