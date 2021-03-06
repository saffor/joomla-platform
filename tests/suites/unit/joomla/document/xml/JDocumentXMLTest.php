<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Document
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_PLATFORM . '/joomla/document/document.php';
require_once JPATH_PLATFORM . '/joomla/document/xml/xml.php';

/**
 * Test class for JDocumentXML.
 * Generated by PHPUnit on 2009-10-09 at 14:00:04.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Document
 * @since       11.1
 */
class JDocumentXMLTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var    JDocumentXML
	 * @access protected
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->object = new JDocumentXML;
	}

	/**
	 * Test Render
	 *
	 * @todo Implement testRender().
	 *
	 * @return void
	 */
	public function testRender()
	{
		JResponse::clearHeaders();

		$this->object->setBuffer('Unit Test Buffer');

		$this->assertThat(
			$this->object->render(),
			$this->equalTo('Unit Test Buffer'),
			'We did not get the buffer back properly'
		);

		$headers = JResponse::getHeaders();

		$disposition = false;

		foreach ($headers as $head)
		{
			if ($head['name'] == 'Content-disposition')
			{				
				$this->assertThat(
					$head['value'],
					$this->stringContains('.xml'),
					'The content disposition did not include json extension'
				);
				$disposition = true;
			}
		}

		$this->assertThat(
			$disposition,
			$this->equalTo(true),
			'No Content-disposition headers'
		);
	}

	/**
	 * We test both at once
	 *
	 * @return void
	 */
	public function testGetAndSetName()
	{
		$this->object->setName('unittestfilename');

		$this->assertThat(
			$this->object->getName(),
			$this->equalTo('unittestfilename'),
			'setName or getName did not work'
		);
	}
}
