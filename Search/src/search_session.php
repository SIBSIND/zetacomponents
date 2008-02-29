<?php
/**
 * File containing the ezcSearchSession class.
 *
 * @package Search
 * @version //autogen//
 * @copyright Copyright (C) 2005-2008 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */

/**
 * ezcSearchSession is the main runtime interface for searching documents.
 *
 * @property-read ezcSearchHandler $handler
 *                The handler set in the constructor.
 * @property-read ezcSearchDefinitionManager $definitionManager
 *                The persistent definition manager set in the constructor.
 *
 * @package Search
 * @version //autogen//
 * @mainclass
 */
class ezcSearchSession
{
    /**
     * Holds the properties of this class.
     *
     * @var array(string=>mixed)
     */
    private $properties = array();

    /**
     * Constructs a new search session that works on the handler $handler.
     *
     * The $manager provides valid search document definitions to the
     * session. The $handler will be used to perform all search operations.
     *
     * @param ezcSearchHandler $backend
     * @param ezcSearchDefinitionManager $manager
     */
    public function __construct( ezcSearchHandler $handler, ezcSearchDefinitionManager $manager )
    {
        $this->properties['handler']           = $handler;
        $this->properties['definitionManager'] = $manager;
    }

    /**
     * Returns the result of the search query $query as a list of objects.
     *
	 * Returns the documents found for document type $type using the submitted
	 * $query. $query should be created using {@link createFindQuery()}.
     *
     * Example:
     * <code>
     * $q = $session->createFindQuery();
     * $allPersons = $session->find( $q );
     * </code>
     *
     * If you are retrieving large result set, consider using {@link
     * findIterator()} instead.
     *
     * Example:
     * <code>
     * $q = $session->createFindQuery();
     * $documents = $session->findIterator( $q );
     *
     * foreach ( $documents as $document )
     * {
     *     // ...
     * }
     * </code>
     *
     * @throws ezcSearchDefinitionNotFoundException
     *         if there is no such persistent class.
     * @throws ezcSearchQueryException
     *         if the find query failed.
     *
     * @param ezcSearchQuery $query
     * @param string $type
     *
     * @return array(object($class))
     */
    public function find( ezcSearchQuery $query, $type )
    {
        return $this->findHandler->find( $query, $type );
    }

    /**
     * Returns the result of $query for the $class as an iterator.
     *
     * This method is similar to {@link find()} but returns an {@link
     * ezcSearchFindIterator} instead of an array of documents. This is
     * useful if you are going to loop over the documents and just need them one
     * at the time.  Because you only instantiate one document it is faster than
     * {@link find()}. In addition, only 1 record is retrieved from the
	 * database in each iteration, which may reduce the data transfered between
	 * the search backend and PHP, if you iterate only through a small subset
	 * of the affected records.
     *
     * @throws ezcSearchDefinitionNotFoundException
     *         if there is no such persistent class.
     * @throws ezcSearchQueryException
     *         if the find query failed.
     *
     * @param ezcSearchQuery $query
     *
     * @return ezcSearchFindIterator
     */
    public function findIterator( ezcQuerySelect $query, $type )
    {
        return $this->findHandler->findIterator( $query, $type );
    }

    /**
     * Returns a search query for the given document type $type.
     *
     * The query is initialized to fetch all properties.
     *
     * Example:
     * <code>
     * $q = $session->createFindQuery( 'Person' );
     * $allPersons = $session->find( $q, 'Person' );
     * </code>
     *
     * @throws ezcSearchException
     *         if there is no such document type.
     *
     * @param string $type
     *
     * @return ezcQuerySelect
     */
    public function createFindQuery( $type )
    {
        return $this->findHandler->createFindQuery( $type );
    }

    /**
     * Starts a transaction for indexing.
     *
     * When using a transaction, the amount of processing that solr does
     * decreases, increasing indexing performance. Without this, the component
     * sends a commit after every document that is indexed. Transactions can be
     * nested, when commit() is called the same number of times as
     * beginTransaction(), the component sends a commit.
     */
    public function beginTransaction()
    {
        $this->handler->beginTransaction();
    }

    /**
     * Ends a transaction and calls commit.
     *
     * As transactions can be nested, this method will only call commit when
     * all the nested transactions have been ended.
     *
     * @throws ezcSearchTransactionException if no transaction is active.
     */
    public function commit()
    {
        $this->handler->commit();
    }
    /**
     * Indexes the new document $document to the search index.
     *
     * @throws ezcSearchException if $document
     *         is not of a valid document type.
     * @throws ezcSearchException
     *         if it was not possible to generate a unique identifier for the
     *         new object.
     * @throws ezcSearchException
     *         if the indexing failed
     *
     * @param object $document
     */
    public function index( $document )
    {
        $class = get_class( $document );
        $def   = $this->definitionManager->fetchDefinition( $class );
        $state = $document->getState();
        if ( $state[$def->idProperty] == null )
        {
            $document->setState( array( $def->idProperty => uniqid() ) );
        }
        $this->handler->index( $def, $document->getState() );
    }

    /**
     * Indexes a new document after removing the old one first.
     *
     * @throws ezcSearchDefinitionNotFoundException if $document is not of a valid document type.
     * @throws ezcSearchDocumentNotAvailableException if $document is not stored in the database already.
     * @param object $document
     * @return void
     */
    public function update( $document )
    {
		$this->delete( $document );
        return $this->index( $document );
    }

    /**
     * Deletes the document $document from the index.
     *
     * @throws ezcSearchDefinitionNotFoundxception
     *         if the object is not recognized as valid document type.
     * @throws ezcSearchDocumentNotAvailableException if $document is not stored in the database already
     * @throws ezcSearchQueryException
     *         if the object could not be deleted.
     *
     * @param object $document The document to delete
     */
    public function delete( $document )
    {
        return $this->deleteHandler->delete( $document );
    }

    /**
     * Deletes documents using the query $query.
     *
     * The $query should be created using {@link createDeleteQuery()}.
     *
     * @throws ezcSearchQueryException
     *         if the delete query failed.
     *
     * @param ezcSearchDeleteQuery $query
     */
    public function deleteFromQuery( ezcSearchDeleteQuery $query )
    {
        return $this->deleteHandler->deleteFromQuery( $query );
    }

    /**
     * Returns a delete query for the given document type $type.
     *
     * Example:
     * <code>
     * $q = $session->createDeleteQuery( 'Person' );
     * $q->where( $q->gt( 'age', $q->bindValue( 15 ) ) );
     * $session->deleteFromQuery( $q );
     * </code>
     *
     * @throws ezcSearchException
     *         if there is no such document type.
     *
     * @param string $type
     *
     * @return ezcQueryDelete
     */
    public function createDeleteQuery( $type )
    {
        return $this->deleteHandler->createDeleteQuery( $type );
    }

    /**
     * Sets the property $name to $value.
     *
     * @throws ezcBasePropertyNotFoundException
     *         if the property does not exist.
     *
     * @param string $name
     * @param mixed $value
     *
     * @ignore
     */
    public function __set( $name, $value )
    {
        switch ( $name )
        {
            case 'database':
            case 'definitionManager':
            case 'findHandler':
            case 'indexHandler':
            case 'deleteHandler':
                throw new ezcBasePropertyPermissionException( $name, ezcBasePropertyPermissionException::READ );

            default:
                throw new ezcBasePropertyNotFoundException( $name );
                break;
        }

    }

    /**
     * Property get access.
     *
     * Simply returns a given property.
     * 
     * @throws ezcBasePropertyNotFoundException
     *         If a the value for the property propertys is not an instance of
     * @param string $propertyName The name of the property to get.
     * @return mixed The property value.
     *
     * @ignore
     *
     * @throws ezcBasePropertyNotFoundException
     *         if the given property does not exist.
     * @throws ezcBasePropertyPermissionException
     *         if the property to be set is a write-only property.
     */
    public function __get( $propertyName )
    {
        if ( $this->__isset( $propertyName ) === true )
        {
            return $this->properties[$propertyName];
        }
        throw new ezcBasePropertyNotFoundException( $propertyName );
    }

    /**
     * Returns if a property exists.
     *
     * Returns true if the property exists in the {@link $properties} array
     * (even if it is null) and false otherwise. 
     *
     * @param string $propertyName Option name to check for.
     * @return void
     * @ignore
     */
    public function __isset( $propertyName )
    {
        return array_key_exists( $propertyName, $this->properties );
    }
}
?>