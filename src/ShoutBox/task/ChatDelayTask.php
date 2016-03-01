<?php
//
namespace ShoutBox\task;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;

class ChatDelayTask extends PluginTask {
	protected $owner;
	public function __construct(Plugin $owner) {
		parent::__construct ( $owner );
		$this->owner = $owner;
	}
	public function onRun($currentTick) {
		if($this->owner->getMute())
    		$this->owner->setMute(false);
    	$this->owner->getLogger()->info("빼애애애액 태스크 실행됨!!");
	}
}
?>