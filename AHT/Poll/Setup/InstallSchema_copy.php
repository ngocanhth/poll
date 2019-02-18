<?php
namespace AHT\Poll\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context){
		$setup->startSetup();
		$conn=$setup->getConnection();

/**
 * Create table 'poll'
 */


		$tableName=$setup->getTable('poll');
		if($conn->isTableExists($tableName) != true){
			$table=$conn->newTable($tableName);
			$columns=[
				"id" => [
					"type" => Table::TYPE_INTEGER,
					"size" => null,
					"options" => [
						"identity" => true,		//Auto increment
						"unsigned" => true,		//Không âm
						"nullable" => false, //Không rỗng
						"primary"  => true,
					]
				],
				"poll_title" => [
					"type" => Table::TYPE_TEXT,
					"size" => 255,
					"options" => [
						"nullable" => false,
						"default" => ""
					]
				],
				"votes_count" => [
					"type" => Table::TYPE_INTEGER,
					"size" => null,
					"options" => [
						"nullable" => false,
						'unsigned'  => true,
						"default" => "0"
					]
				],	
				"store_id" => [
					"type" => Table::TYPE_SMALLINT,
					"size" => null,
					"options" => [
						"nullable" => false,
						'unsigned'  => true,
						"default" => "0"
					]
				],
				"date_posted" => [
					"type" => Table::TYPE_TIMESTAMP,
					"size" => null,
					"options" => [
						"nullable" => false
					]
				],	
				"date_closed" => [
					"type" => Table::TYPE_TIMESTAMP,
					"size" => null,
					"options" => [
						"nullable" => true
					]
				],
				"status" => [
					"type" => Table::TYPE_BOOLEAN,
					"size" => null,
					"options" => [
						"nullable" => false,
						"default" => 0
					]
				],
				"active" => [
					"type" => Table::TYPE_SMALLINT,
					"size" => null,
					"options" => [
						"nullable" => false,
						"default" => "1"
					]
				],
				"closed" => [
					"type" => Table::TYPE_SMALLINT,
					"size" => null,
					"options" => [
						"nullable" => false,
						"default" => "0"
					]
				],
				"answers_display" => [
					"type" => Table::TYPE_SMALLINT,
					"size" => null,
					"options" => [
						"nullable" => true
					]
				]																									
			];

			foreach($columns as $name=>$value){
				$table->addColumn(
					$name,
					$value["type"],
					$value["size"],
					$value["options"]);
			}
			$table->setOption("charset","utf8");
			$conn->createTable($table);
		}


/**
 * Create table 'poll_answer'
 */



$tableName=$setup->getTable('poll_answer');
		if($conn->isTableExists($tableName) != true){
			$table=$conn->newTable($tableName);
			$columns=[
				"id" => [
					"type" => Table::TYPE_INTEGER,
					"size" => null,
					"options" => [
						"identity" => true,		//Auto increment
						"unsigned" => true,		//Không âm
						"nullable" => false, //Không rỗng
						"primary"  => true,
					]
				],

				"answer_id" => [
					"type" => Table::TYPE_INTEGER,
					"size" => null,
					"options" => [
						"identity" => true,		
						"unsigned" => true,		
						"nullable" => false, 
						"primary"  => true,
					]
				],

				"answer_title" => [
					"type" => Table::TYPE_TEXT,
					"size" => 255,
					"options" => [
						"nullable" => false,
						"default" => ""
					]
				],
				"votes_count" => [
					"type" => Table::TYPE_INTEGER,
					"size" => null,
					"options" => [
						"nullable" => false,
						'unsigned'  => true,
						"default" => "0"
					]
				],	
				"answer_order" => [
					"type" => Table::TYPE_SMALLINT,
					"size" => null,
					"options" => [
						"nullable" => false,
						'unsigned'  => true,
						"default" => "0"
					]
				]																								
			];

			foreach($columns as $name=>$value){
				$table->addColumn(
					$name,
					$value["type"],
					$value["size"],
					$value["options"]);
			}
			$table->setOption("charset","utf8");
			$conn->createTable($table);
		}


		$setup->endSetup();
	}
}