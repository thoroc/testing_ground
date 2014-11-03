<?php

namespace WeatherData\includes;

use WeatherData\entity\Tree;

function displayNavigation( $alias = null )
{
    $tree = init();

    return ( null === $alias ) ? $tree->display( 1 ) : $tree->displaySubTree( $alias );
}

/**
 * Be aware when giving a title and an alias to a new page, to give the same values
 * when adding a node to the tree.
 *
 * This should really be set in a config file outside both the page and the code
 * below.
 *
 * @return Tree
 */
function init()
{
    $tree = new Tree( 'Home', 'root', 'index.php' );
    $root = $tree->getRoot();
    $node1 = $tree->addNode( 'Reports', 'reports', 'reports.php', $root );
    $node2 = $tree->addNode( 'Uploads', 'uploads', 'uploads.php', $root );
    $node3 = $tree->addNode( 'Admin', 'admin', 'admin.php', $root );
    // report sub menu
    $node4 = $tree->addNode( 'Raw excel export', 'reports_excel', 'reports.php?query=excel', $node1 );
    $node5 = $tree->addNode( 'Graphs', 'reports_graphs', 'reports.php?query=graphs', $node1 );
    // admin sub menu
    $node6 = $tree->addNode( 'DB Stats', 'admin_stats', 'stats.php', $node3 );
    $node7 = $tree->addNode( 'Data removal', 'admin_data', 'data.php', $node3 );
    $node8 = $tree->addNode( 'Session removal', 'session_remove', 'session.php?query=remove', $node3 );
    $node9 = $tree->addNode( 'Session cleaning', 'session_clean', 'session.php?query=clean', $node3 );
    // test page
    $node10 = $tree->addNode( 'Testing', 'testing', 'test.php', $root );

    return $tree;
}
