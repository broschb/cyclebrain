<?php


/**
 * This class adds structure of 'users' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * 06/28/09 19:43:56
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UsersMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UsersMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(UsersPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UsersPeer::TABLE_NAME);
		$tMap->setPhpName('Users');
		$tMap->setClassname('Users');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('USERNAME', 'Username', 'VARCHAR', true, 15);

		$tMap->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 40);

		$tMap->addColumn('FNAME', 'Fname', 'VARCHAR', true, 45);

		$tMap->addColumn('LNAME', 'Lname', 'VARCHAR', true, 45);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', true, 45);

		$tMap->addPrimaryKey('USER_ID', 'UserId', 'INTEGER', true, 10);

		$tMap->addColumn('SALT', 'Salt', 'VARCHAR', true, 32);

		$tMap->addColumn('ACTIVE', 'Active', 'VARCHAR', true, 1);

		$tMap->addColumn('JOIN_DATE', 'JoinDate', 'TIMESTAMP', true, null);

	} // doBuild()

} // UsersMapBuilder
