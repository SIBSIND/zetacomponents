<?php
/**
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 * @version //autogentag//
 * @filesource
 * @package Tree
 */

/**
 * ezcTreePersistentObjectDataStore is a tree data store that stores persistent
 * objects.
 *
 * @package Tree
 * @version //autogentag//
 * @mainclass
 */
class ezcTreePersistentObjectDataStore extends ezcTreeDbDataStore
{
    /**
     * Contains the persistent session object
     *
     * @var ezcPersistentSession
     */
    private $session;

    /**
     * Contains the class name of the objects that belong to the tree
     *
     * @var string
     */
    private $class;

    /**
     * Contains the name of the table field that contains the ID.
     *
     * @var string
     */
    private $idField = null;

    /**
     * Contains the name of the object property that contains the ID.
     *
     * @var string
     */
    private $idProperty = null;

    /**
     * Constructs a new storage backend that stores objects through persistent
     * objects.
     *
     * The store will use the persistent session specified by $session. The
     * $class parameter specifies which object class is used.  The class'
     * property that is matched against the node ID is specified with
     * $idProperty.
     *
     * @param ezcPersistentSession $session
     * @param string $class
     * @param string $idProperty
     */
    public function __construct( ezcPersistentSession $session, $class, $idProperty )
    {
        $this->session = $session;
        $this->class = $class;

        // figure out which column belongs to the property in $idProperty
        $def = $session->definitionManager->fetchDefinition( $class );

        $this->idField = $def->idProperty->columnName;
        $this->idProperty = $idProperty;
    }

    /**
     * Deletes the data for the node $node from the data store.
     *
     * @param ezcTreeNode $node
    public function deleteDataForNode( ezcTreeNode $node )
    {
    }
     */

    /**
     * Deletes the data for all the nodes in the node list $nodeList.
     *
     * @param ezcTreeNodeList $nodeList
     */
    public function deleteDataForNodes( ezcTreeNodeList $nodeList )
    {
        $session = $this->session;

        $nodeIdsToDelete = array();
        foreach ( array_keys( $nodeList->nodes ) as $id )
        {
            $nodeIdsToDelete[] = (string) $id;
        }

        $q = $session->createDeleteQuery( $this->class );
        $q->where( $q->expr->in( $this->session->database->quoteIdentifier( $this->idField ), $nodeIdsToDelete ) );
        $session->deleteFromQuery( $q );
    }

    /**
     * Deletes the data for all the nodes in the store.
     */
    public function deleteDataForAllNodes()
    {
        $session = $this->session;

        $q = $session->createDeleteQuery( $this->class );
        $session->deleteFromQuery( $q );
    }

    /**
     * Retrieves the data for the node $node from the data store and assigns it
     * to the node's 'data' property.
     *
     * @param ezcTreeNode $node
     */
    public function fetchDataForNode( ezcTreeNode $node )
    {
        $session = $this->session;

        try
        {
            $q = $session->load( $this->class, $node->id );
        }
        catch ( ezcPersistentQueryException $e )
        {
            throw new ezcTreeDataStoreMissingDataException( $node->id );
        }

        $node->data = $q;
        $node->dataFetched = true;
    }

    /**
     * This method *tries* to fetch the data for all the nodes in the node list
     * $nodeList and assigns this data to the nodes' 'data' properties.
     *
     * @param ezcTreeNodeList $nodeList
     */
    public function fetchDataForNodes( ezcTreeNodeList $nodeList )
    {
        $session = $this->session;

        $nodeIdsToFetch = array();
        foreach ( $nodeList->nodes as $node )
        {
            if ( $node->dataFetched === false )
            {
                $nodeIdsToFetch[] = $node->id;
            }
        }

        $q = $session->createFindQuery( $this->class );
        $q->where( $q->expr->in( $this->session->database->quoteIdentifier( $this->idField ), $nodeIdsToFetch ) );
        $objects = $session->find( $q, $this->class );

        foreach ( $objects as $object )
        {
            $nodeList[$object->id]->data = $object;
            $nodeList[$object->id]->dataFetched = true;
        }
    }

    /**
     * Stores the data in the node to the data store.
     *
     * @param ezcTreeNode $node
     */
    public function storeDataForNode( ezcTreeNode $node )
    {
        $session = $this->session;

        $idProperty = $this->idProperty;

        // if the object's ID property is null, populate it with the node's ID
        if ( $node->data->$idProperty === null )
        {
            $node->data->$idProperty = $node->id;
        }
        $session->saveOrUpdate( $node->data );

        $node->dataStored = true;
    }
}
?>
