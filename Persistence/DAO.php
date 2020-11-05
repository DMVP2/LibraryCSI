<?php

/**
 * Interface for DAO pattern
 */
interface DAO
{

    /**
     * Create an element in a database table
     *
     * @param Object $element
     * @return void
     */
    public function create($element);

    /**
     * Query an element of a table from its code
     *
     * @param int $codigo
     * @return Object
     */
    public function search($code);

    /**
     * Modify an element in a database table
     *
     * @param Object $element
     * @return void
     */
    public function update($element);

    /**
     * Removes an element from a table from its code
     *
     * @param int $code
     * @return Object
     */
    public function delete($code);

    /**
     * Gets a list of elements of a table from the database
     *
     * @return Object[]
     */
    public function list();
}