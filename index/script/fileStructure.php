<?php

//function getDirStructure( $path = null, $depth = 1 ) {
    // Create recursive dir iterator which skips dot folders
//    $dir = new RecursiveDirectoryIterator( $path, FilesystemIterator::SKIP_DOTS );
    $dir = new RecursiveDirectoryIterator( '../../..', FilesystemIterator::SKIP_DOTS );
    // Flatten the recursive iterator, folders come before their files
    $it = new RecursiveIteratorIterator( $dir, RecursiveIteratorIterator::SELF_FIRST );
    // Maximum depth is 1 level deeper than the base folder
//    $it->setMaxDepth( $depth );
    $it->setMaxDepth( 1 );
//    $structure = array();
    $directories = array();
    $files = array();

    // Basic loop displaying different messages based on file or folder
    foreach( $it as $fileinfo )
    {
        if( $fileinfo->isDir() )
        {
            $directories[] = $fileinfo->getFilename();
//            printf( "Folder - %s\n", $fileinfo->getFilename() );
        }
        elseif( $fileinfo->isFile() )
        {
            $files[] = $fileinfo->getFilename();
//            printf( "File From %s - %s\n", $it->getSubPath(), $fileinfo->getFilename() );
        }
    }

    echo json_encode( array( $directories, $files ));
//}