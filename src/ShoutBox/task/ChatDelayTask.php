<?php
//
namespace ShoutBox\task;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;

class ChatDelayTask extends PluginTask {
	protected $owner;
	public function __construct(Plugin $owner) {
		parent::__construct ( $owner );
	}
	public function onRun($currentTick) {
     $this->owner->mute = false;
	}
}
?>
