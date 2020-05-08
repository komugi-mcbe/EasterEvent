<?php

namespace xtakumatutix\easter;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\level\Level;
use pocketmine\Player;
use pocketmine\item\Item;

Class Main extends PluginBase implements Listener {

    public function onEnable(){
        $this->getLogger()->notice("読み込み完了_ver.1.0.0");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

	public function onBreak(BlockBreakEvent $event)
	{
		$player = $event->getPlayer();
		$block = $event->getBlock()->getID();
		switch($player->getlevel()->getName())
		{
			case "event";
			if($block == 17){
				if(mt_rand(0 , 1) == 1){
					$this->woodegg($player);
				}
			}

			if($block == 2 or $block == 3){
				if(mt_rand(0 , 1) == 1){
					$this->soilegg($player);
				}
			}

			if($block == 1){
				if(mt_rand(0 , 1) == 1){
				    $this->stoneegg($player);
				}
			}

			if($block == 18){
				if(mt_rand(0 , 1) == 1){
					$this->reefegg($player);
				}
			}
			break;
		}
	}

    public function woodegg(Player $player)
    {
    	if(!$player->getInventory()->canAddItem(Item::get(344,0,1))){
    		$player->sendMessage(" >> おっと卵をゲットしたのにインベントリがいっぱいで、捨てちゃった...");
    	}else{
    		$item = Item::get(344,0,1);
    		$item->setCustomName("§6木§fの§e卵§r");
    		$player->getInventory()->addItem($item);
    		$player->sendMessage("§a >> §6木§fの§e卵§fをゲット！");
    	}
    }

    public function soilegg(Player $player)
    {
    	if(!$player->getInventory()->canAddItem(Item::get(344,0,1))){
    		$player->sendMessage(" >> おっと卵をゲットしたのにインベントリがいっぱいで、捨てちゃった...");
    	}else{
    		$item = Item::get(344,0,1);
    		$item->setCustomName("§6土§fの§e卵§r");
    		$player->getInventory()->addItem($item);
    		$player->sendMessage("§a >> §6土§fの§e卵§fをゲット！");
    	}
    }

    public function stoneegg(Player $player)
    {
    	if(!$player->getInventory()->canAddItem(Item::get(344,0,1))){
    		$player->sendMessage(" >> おっと卵をゲットしたのにインベントリがいっぱいで、捨てちゃった...");
    	}else{
    		$item = Item::get(344,0,1);
    		$item->setCustomName("§7石§fの§e卵§r");
    		$player->getInventory()->addItem($item);
    		$player->sendMessage("§a >> §7石§fの§e卵§fをゲット！");
    	}
    }

    public function reefegg(Player $player)
    {
    	if(!$player->getInventory()->canAddItem(Item::get(344,0,1))){
    		$player->sendMessage(" >> おっと卵をゲットしたのにインベントリがいっぱいで、捨てちゃった...");
    	}else{
    		$item = Item::get(344,0,1);
    		$item->setCustomName("§a葉っぱ§fの§e卵§r");
    		$player->getInventory()->addItem($item);
    		$player->sendMessage("§a >> §a葉っぱ§fの§e卵§fをゲット！");
    	}
    }
}