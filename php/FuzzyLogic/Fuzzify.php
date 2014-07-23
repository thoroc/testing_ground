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
error_reporting( 5 );

class Fuzzify extends Member
{
    protected $min = array();
    protected $max = array();
    protected $members = array();

    public function setMinMax( $idx, $A = 0, $B = 0 )
    {
        If( $A <= $B )
        {
            $this->min[$idx] = $A;
            $this->max[$idx] = $B;
        }
        else
        {
            $this->min[$idx] = $B;
            $this->max[$idx] = $A;
        }
    }

    public function clearMembers()
    {
        $this->members = NULL;
    }

    public function addMember( $idx, $Name = 'New', $start = 0.0, $medium = 0.0, $stop = 0.0, $type = Member::TRIANGLE )
    {
        $member = new Member( $Name, $start, $medium, $stop, $type );
        if( $member->start < ( float ) $this->min[$idx] ) $this->setMinMax( $idx, $member->start, ( float ) $this->max[$idx] );
        if( $member->end > ( float ) $this->max[$idx] ) $this->setMinMax( $idx, ( float ) $this->min[$idx], $member->end );
        $this->members[$idx][] = $member;
    }

    public function setMembers( $idx, $m = array() )
    {
        $this->members[$idx] = $m;
    }

    public function getMembers( $idx, $id = NULL )
    {
        if( !is_null( $id ) )
        {
            return $this->members[$idx][$id];
        }
        else if( !is_null( $idx ) )
        {
            return $this->members[$idx];
        }
        else
        {
            return $this->members;
        }
    }

    public function getMembersIndex( $idx, $value = NULL )
    {
        foreach( $this->members[$idx] as $idx => $member ) if( $value === $member->name ) return $idx;
        return FALSE;
    }

    public function getMemberByName( $idx, $name = NULL )
    {
        foreach( $this->members[$idx] as $idx => $member ) if( $name === $member->name ) return $member;
        return FALSE;
    }
}