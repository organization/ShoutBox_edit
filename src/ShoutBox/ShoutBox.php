<?php

namespace ShoutBox;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\scheduler\PluginTask;
use ShoutBox\task\ChatDelayTask;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\Server;

class ShoutBox extends PluginBase implements Listener {
	private $mute = false;
	public function onEnable() {
		$this->getLogger()->info("§3✿ ShoutBox_v1.0 on Loading ✿");
    $this->getServer()->getPluginManager()->registerEvents($this,$this);
  }
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
  	switch(strtolower($command->getName())){
  		case "일반확성기":
  		if(!$sender->getInventory()->contains(new Item(116, 0, 1))){
  		  $sender->sendMessage ("§3[ 서버 ] 확성기 사용권이 부족합니다 !");
  		  $sender->sendMessage ("§3[ 서버 ] 일반 확성기는 사용권이 1개가 필요합니다 !");
        return true;
  	  }
  	  $sender->getInventory()->removeItem(new Item(116, 0, 1));
  	  $message = implode(" ", $args);
  	  $this->getServer()->broadcastMessage("§6[ 일반확성기 ] ". $sender->getName() ." : $message");
      $sender->sendMessage("§3[ 서버 ] 확성기 사용권 1개를 사용하였습니다 !");
	  $this->mute = true;
	  $task = new ChatDelayTask($this);
      $this->getServer()->getScheduler()->scheduleDelayedTask($task, 100);
      return true;
      break;
      case "고급확성기":
      if(!$sender->getInventory()->contains(new Item(116, 0, 3))){
  		  $sender->sendMessage ("§3[ 서버 ] 확성기 사용권이 부족합니다 !");
  		  $sender->sendMessage ("§3[ 서버 ] 고급 확성기는 사용권이 3개가 필요합니다 !");
        return true;
  	  }
  	  $sender->getInventory()->removeItem(new Item(116, 0, 3));
  	  $message = implode(" ", $args);
  	  $this->getServer()->broadcastMessage ("§7✿--------------------------------------✿");
  	  $this->getServer()->broadcastMessage ("§6[ 고급확성기 ] ".$sender->getName()." : $message");
  	  $this->getServer()->broadcastMessage ("§7✿--------------------------------------✿");
  	  $sender->sendMessage("§3[ 서버 ] 확성기 사용권 3개를 사용하였습니다 !");
	  $this->mute = true;
	  $task = new ChatDelayTask($this);
  	  $this->getServer()->getScheduler()->scheduleDelayedTask($task, 200);
  	  return true;
  	}
  }
    public function onChat(PlayerChatEvent $event) {
		if ( $this->mute === true) {
			$event->setCancelled ();
			return;
		}
	}
	public function setMute($bool) {
		$this->mute = $bool;
	}
	public function getMute() {
		return $this->mute;
	}
}

?>