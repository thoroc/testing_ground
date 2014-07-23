<?php
/* * *************************************************************
 *
 *      (c) 2011 Wojtek Jarzęcki (lottocad(nospam)@gmail.com)
 *      All rights reserved
 *
 * 	   BSD Licence
 *
 * Date: 2013-01-22
 * Modified by: iJab(zhancaibaoATgmail.com)
 *  Parse MatLab Rules of Fuzzy Logic
 *
 * ************************************************************* */

namespace FuzzyLogic;

error_reporting( 5 );

class Member
{
    const LINFINITY = -1;
    const TRIANGLE = 0;
    const RINFINITY = 1;
    const TRAPEZOID = 2;
    protected
            $name, // Member Name
            $middle, // Middle Member point
            $start, // Start Member point
            $end, // End member point
            $type;   // Member type TRIANGLE,LINFINITY,RFINFINITY, TRAPEZOID

    public function __construct( $name = NULL, $start = NULL, $medium = NULL, $stop = NULL, $type = NULL )
    {
        if( is_null( $name ) ) return;
        $this->name = $name;
        $this->middle = $medium;
        $this->start = $start;
        $this->end = $stop;
        $this->type = $type;
    }

    public function __toString()
    {
        return "Member\tname: $this->name,
                middle: $this->middle,
                start : $this->start,
                fb    : $this->end,
                type  : $this->type";
    }

    /**
     * Get Name of Membership
     * @param   void
     * @return   string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get Type of Membership
     *
     * @param   void
     * @return   string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Calculates the ratio of belonging to a set of defined function shape.
     *
     *    $ratio = Fuzzification($pontX);
     *
     * @param   float 	$poinX
     * @return   float
     */
    public function Fuzzification( $P = 0.0 )
    {
        if(( $P < $this->start ) OR ( $P > $this->end ))
        {
            return 0;
        } //P is out this segment...

        if( $P === $this->middle )
        {
            return 1;
        }

        if( $this->type === self::LINFINITY )
        {
            if( $P <= $this->middle )
            {
                return 1;
            }
            if(( $P > $this->middle ) AND ( $P < $this->end ))
            {
                return ( $this->end - $P ) / ( $this->end - $this->middle );
            }
        }

        if( $this->type === self::RINFINITY )
        {
            if( $P >= $this->middle )
            {
                return 1;
            }
            if(( $P < $this->middle ) AND ( $P > $this->start ))
            {
                return ( $P - $this->start ) / ( $this->middle - $this->start );
            }
        }

        if( $this->type === self::TRIANGLE )
        {
            if(( $P < $this->middle ) AND ( $P > $this->start ))
            {
                return ( $P - $this->start ) / ( $this->middle - $this->start );
            }
            if(( $P > $this->middle ) AND ( $P < $this->end ))
            {
                return ( $this->end - $P ) / ( $this->end - $this->middle );
            }
        }

        if( $this->type === self::TRAPEZOID )
        {
            if(( $P < $this->middle[0] ) AND ( $P > $this->start ))
            {
                return ( $P - $this->start ) / ( $this->middle[0] - $this->start );
            }
            if(( $P > $this->middle[1] ) AND ( $P < $this->end ))
            {
                return ( $this->end - $P ) / ( $this->end - $this->middle[1] );
            }
            if(( $P >= $this->middle[0] ) AND ( $P <= $this->middle[1] ))
            {
                return 1;
            }
        }

        return 0;
    }
}