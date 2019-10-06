<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VirementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VirementsTable Test Case
 */
class VirementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VirementsTable
     */
    public $Virements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Virements',
        'app.Comptes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Virements') ? [] : ['className' => VirementsTable::class];
        $this->Virements = TableRegistry::getTableLocator()->get('Virements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Virements);

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
