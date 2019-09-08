<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComptesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComptesTable Test Case
 */
class ComptesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComptesTable
     */
    public $Comptes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Comptes',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Comptes') ? [] : ['className' => ComptesTable::class];
        $this->Comptes = TableRegistry::getTableLocator()->get('Comptes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Comptes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
